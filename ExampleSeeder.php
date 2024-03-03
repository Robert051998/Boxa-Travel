
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExampleSeeder extends Seeder
{
    public function run()
    {
        DB::table('your_table_name')->insert([
            'column1' => 'value1',
            'column2' => 'value2',
            // ...
        ]);
    }
}
