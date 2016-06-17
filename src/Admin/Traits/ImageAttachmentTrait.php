<?php

namespace Larapress\Admin\Traits;

use Symfony\Component\HttpFoundation\Request;
use Larapress\Admin\Models\Attachment;

trait ImageAttachmentTrait
{
    /**
     * This array indexs all the required input records
     */
    private $inputIndex;

    /**
     * This is an array of the attachment names, typically there will only be one
     */
    private $attachmentNames;


    /**
     * Saves all the image attachments to the DB
     */
    public function saveImageAttachments(Request $request)
    {
        $this->attachmentNames = $this->getImageAttachmentNames();

        //first of all create the index of all input attachments
        foreach ($request->all() as $key => $input) {
            $this->addToInputIndex($key);
        }

        //go through index and save them to database
        foreach ($this->attachmentNames as $context) {
            foreach ($this->inputIndex[$context]['identifiers'] as $attachmentID) {
                $field = $context . '_' . $attachmentID . '_';
                Attachment::create([
                    'context' => $context,
                    'url' => $request->get($field . 'image'),
                    'alt' => $request->get($field . 'alt'),
                    'caption' => $request->get($field . 'caption'),
                    'status' => 'active'
                ]);
            }
        }
    }


    /**
     * Checks and adds to index of attachemnt fields, each field should have three parts separated by
     * '_'. The first is the attachment name, second is the unique id for the records to that field,
     * the third is the fields, ie 'alt, caption, url'
     */
    private function addToInputIndex($fieldName)
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
    private function getImageAttachmentNames()
    {
        if (is_array($this->imageAttachmentNames)) return $this->imageAttachmentNames;

        return [$this->imageAttachmentNames];
    }

}