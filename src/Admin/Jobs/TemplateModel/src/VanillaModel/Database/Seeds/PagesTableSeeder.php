--php
namespace {Vendor}\{Package}\{Models}\Database\Seeds;

use Illuminate\Database\Seeder;
use {Vendor}\{Package}\{Models}\Database\Factories\Factory;

class {models}TableSeeder extends Seeder
{
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->factory->{model}()->save();
    }
}
