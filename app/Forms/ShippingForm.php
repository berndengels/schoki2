<?php
/**
 * ImageForm.php
 *
 * @author    Bernd Engels
 * @created   25.02.19 14:47
 * @copyright Bernd Engels
 */
namespace App\Forms;

use App\Models\Country;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class ShippingForm extends Form
{
    protected $formOptions = [
        'id'    => 'frmShipping',
        'method' => 'POST',
		'class' => 'mx-sm-1 mx-md-3 col-md-6',
    ];

    public function buildForm()
    {
        parent::buildForm();
        $model      = $this->getModel() ?: null;
        $id         = $model ? $model->id : null;
        $country    = $this->getData('country');
        $language   = $this->getData('language');
        $this
            ->add('country_id', Field::ENTITY, [
                'class' => Country::class,
				'label'	=> 'Land',
                'property' => $language,
                'selected'  => $country->id,
                'empty_value'  => 'Bitte wählen ...',
				'query_builder' => function (Country $item) {
					return $item->orderBy('code');
				},
                'rules' => ['required'],
			])
            ->add('postcode', Field::TEXT, [
                'rules' => ['required']
            ])
            ->add('city', Field::TEXT, [
                'rules' => ['required']
            ])
            ->add('street', Field::TEXT, [
                'rules' => ['required']
            ])
            ->add('is_default', Field::CHECKBOX, [
                'attr'  => [
                    'checked' => ($model && $model->is_default == 1) ?? false,
                ],
            ])
            ->add('senden', Field::BUTTON_SUBMIT, [
                'attr' => ['class' => 'btn btn-primary pull-right'],
            ])
        ;
        if( $id > 0 ) {
            $this->formOptions['url'] = "/shipping/update/$id";
        } else {
            $this->formOptions['url'] = "/shipping/store";
        }
    }
}
