@php
$form_data = [
	'page_title'=> 'Payment Setting Form',
	'page_subtitle'=> 'Payment Setting Page',
	'tab_names' => ['stripe' => 'Stripe'],
	'tab_forms' => [
		
		'stripe' => [
			'action' => URL::to('/').'/admin/settings/payment-methods',
			'form_class' => 'form-submit-jquery',
			'fields' => [
				['type' => 'hidden', 'class' => '', 'label' => '', 'id' =>'stripe', 'name' => 'gateway', 'value' => 'stripe'],
	      		['type' => 'text', 'class' => 'validate_field', 'label' => 'Stripe Secret Key', 'name' => 'secret_key', 'value' => $stripe['secret']],
	      		['type' => 'text', 'class' => 'validate_field', 'label' => 'Stripe Publishable Key', 'name' => 'publishable_key', 'value' => $stripe['publishable']],
	      		['type' => 'select', 'options' => ['0' => 'Inactive', '1' => 'Active'], 'class' => 'validate_field', 'label' => 'Stripe Status', 'name' => 'stripe_status', 'value' => $stripe['stripe_status']],
			]
		],
		'banks' => true,
	]
];
@endphp

@include("admin.common.form.setting-multi-tab", $form_data)


