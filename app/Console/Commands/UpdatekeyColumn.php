<?php

namespace App\Console\Commands;

use App\Models\FormData;
use Illuminate\Console\Command;

class UpdatekeyColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update key value of column to related form';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $forms_data = FormData::where('key','comment')->get()->groupBy('entry_id');
        foreach($forms_data as $form_data_fields) {
            $columns_rename = [
                "bio_data_comment",
                "vitals_bmi_comment",
                "general_apperance_comment",
                "inspect_hygiene_comment",
                "head_and_neck_examination_comment",
                "eye_comment",
                "ears_comment",
                "nose_comment",
                "oral_comment",
                "throat_comment",
                "chest_comment",
                "abdomen_comment",
                "musculoskeletal_comment",
                "vaccination_comment",
                "lead_exposure_comment",
                "miscellaneous_comment",
                "psychological_comment",
            ];
            foreach($form_data_fields as $index => $form_data_field) {
                $form_data_field->key = $columns_rename[$index];
                $form_data_field->save();
            }   
        }
        $forms_data = [];
        $forms_data = FormData::where('key','Question_No_32_External_inasal_examinaton')->get()->groupBy('entry_id');
        foreach($forms_data as $form_data_fields) {
            $columns_rename = [
                "Question_No_32_External_nasal_examinaton"
            ];
            foreach($form_data_fields as $index => $form_data_field) {
                $form_data_field->key = $columns_rename[$index];
                $form_data_field->save();
            }   
        }

        $forms_data = [];
        $forms_data = FormData::where('key',"like",'%Question No.45%')->get()->groupBy('entry_id');
        foreach($forms_data as $form_data_fields) {
            $columns_rename = [
                "Question No.45: Did you observe any limitations in the child's range of joint motion during your examination?"
            ];
            foreach($form_data_fields as $index => $form_data_field) {
                $form_data_field->key = $columns_rename[$index];
                $form_data_field->save();
            }
        }

        $forms_data = FormData::get()->groupBy('entry_id');
        foreach($forms_data as $form_data_fields) {
            foreach($form_data_fields as $index => $form_data_field) {
                $form_data_field->key = str_replace([": ","."," "],"_",$form_data_field->key);
                $form_data_field->save();
            }
        }

        return Command::SUCCESS;
    }
}
