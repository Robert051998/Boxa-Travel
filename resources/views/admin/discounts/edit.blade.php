@php 
$form_data = [
    'page_title'=> 'Edit Discount',
    'page_subtitle'=> '', 
    'form_name' => 'Edit Discount Form',
    'form_id' => 'edit_discount',
    'action' => URL::to('/').'/admin/settings/edit-discounts/'.$result->id,
    'fields' => [
      ['type' => 'text', 'class' => '', 'label' => 'Amount', 'name' => 'amount', 'value' => $result->amount],
      ['type' => 'text', 'class' => '', 'label' => 'Discount Value', 'name' => 'value',  'value' => $result->value],
      ['type' => 'select', 'options' => ['Active' => 'Active', 'Inactive' => 'Inactive'], 'class' => 'validate_field', 'label' => 'Status', 'name' => 'status', 'value' => ''],
    ]
];
@endphp
@include("admin.common.form.setting", $form_data)

<script type="text/javascript">
   $(document).ready(function () {

            $('#edit_property').validate({
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