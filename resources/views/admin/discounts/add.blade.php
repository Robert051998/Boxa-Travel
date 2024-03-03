@php 
$form_data = [
    'page_title'=> 'Add Discount',
    'page_subtitle'=> '', 
    'form_name' => 'Add Discount Form',
    'form_id' => 'add_discount',
    'action' => URL::to('/').'/admin/settings/add-discounts',
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => 'Amount', 'name' => 'amount', 'value' => ''],
      ['type' => 'text', 'class' => '', 'label' => 'Discount Value', 'name' => 'value',  'value' => ''],
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#add_discount').validate({
                rules: {
                    name: {
                        required: true
                    },
                    description: {
                        required: true
                    }
                }
            });

        });
</script>