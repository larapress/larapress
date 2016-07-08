<?php

namespace Larapress\Admin\Traits;

use Symfony\Component\HttpFoundation\Request;
use Larapress\Admin\Models\Attachment;

trait ImageAttachmentTrait
{
    /**
     * This array indexs all the required input records
     */
    protected $inputIndex;

    /**
     * This is an array of the attachment names, typically there will only be one
     */
    protected $attachmentNames;


    /**
     * Saves all the image attachments to the DB
     */
    public function saveImageAttachments(Request $request)
    {
        //get array of all types('context') of attachments for this model
        $this->attachmentNames = $this->getImageAttachmentNames();

        //first of all create the index of all input attachments
        foreach ($request->all() as $key => $input) {
            $this->addToInputIndex($key);
        }


        //go through index and save them to database
        foreach ($this->attachmentNames as $context) {
            if (isset($this->inputIndex[$context])) {
                $priority = 0;
                foreach ($this->inputIndex[$context]['identifiers'] as $attachmentID) {
                    $field = $context . '_' . $attachmentID . '_';

                    //if no id feild, then create a new attachment
                    if ($request->get($field . 'id') == null) {
                        Attachment::create([
                            'context' => $context,
                            'url' => $request->get($field . 'url'),
                            'alt' => $request->get($field . 'alt'),
                            'caption' => $request->get($field . 'caption'),
                            'status' => 'active',
                            'model' => get_class(),
                            'model_id' => $this->id,
                            'priority' => $priority
                        ]);
                    } else {
                        if($request->get($field . 'url') == '' && $request->get($field . 'caption') == '' && $request->get($field . 'alt') == ''){
                            Attachment::destroy($request->get($field . 'id'));
                        }else{
                            $attachment = Attachment::find($request->get($field . 'id'));

                            $attachment->update([
                                'context' => $context,
                                'url' => $request->get($field . 'url'),
                                'alt' => $request->get($field . 'alt'),
                                'caption' => $request->get($field . 'caption'),
                                'status' => 'active',
                                'priority' => $priority
                            ], [
                                'id' => $request->get($field . 'id')
                            ]);
                        }
                    }
                    $priority++;
                }
            }
        }
    }


    /**
     * Returns collection of all image attachments
     * @return mixed
     */
    public function getAllImageAttachments($context = null)
    {
        $model = get_class();

        if($context){
            return Attachment::where('model_id', $this->id)
                ->where('context', $context)
                ->where('model', $model)
                ->orderBy('priority', 'asc')
                ->get();
        }

        //if no context, return all attachments
        return Attachment::where('model_id', $this->id)
            ->where('model', $model)
            ->orderBy('priority', 'asc')
            ->get();
    }


    /**
     * Checks and adds to index of attachemnt fields, each field should have three parts separated by
     * '_'. The first is the attachment name, second is the unique id for the records to that field,
     * the third is the fields, ie 'alt, caption, url'
     */
    protected function addToInputIndex($fieldName)
    {
        $parts = explode('_', $fieldName);

        //check field is attachemnt
        if (!in_array($parts[0], $this->attachmentNames)) return false;

        if (!isset($this->inputIndex[$parts[0]]['identifiers'])) $this->inputIndex[$parts[0]]['identifiers'] = [];

        //if this id is not in index , then add it.
        if (!in_array($parts[1], $this->inputIndex[$parts[0]]['identifiers'])) {
            $this->inputIndex[$parts[0]]['identifiers'][] = $parts[1];
        }

        return;
    }

    /**
     * Returns the defined image attachment names as array
     */
    protected function getImageAttachmentNames()
    {
        if (is_array($this->imageAttachmentNames)) return $this->imageAttachmentNames;

        return [$this->imageAttachmentNames];
    }

}