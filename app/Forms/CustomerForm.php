<?php
/**
 * ImageForm.php
 *
 * @author    Bernd Engels
 * @created   25.02.19 14:47
 * @copyright Bernd Engels
 */
namespace App\Forms;

use App\Models\Shipping;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class CustomerForm extends Form
{
    protected $formOptions = [
        'id'    => 'frmUser',
        'method' => 'POST',
        'url' => '/customer/update',
		'class' => 'mx-sm-1 mx-md-3 col-md-6',
    ];

    public function buildForm()
    {
        parent::buildForm();
        $this
            ->add('music_style_id', Field::ENTITY, [
                'class' => Shipping::class,
				'label'	=> 'Default Adresse',
                'empty_value'  => 'Bitte wählen ...',
				'query_builder' => function (Shipping $item) {
					return $item->orderBy('city');
				}
			])
            ->add('name', Field::TEXT, [
                'rules' => ['required','max:50']
            ])
            ->add('email', Field::EMAIL, [
                'rules' => ['required','email']
            ])
            ->add('password', Field::PASSWORD, [
				'label'	=> 'Passwort',
                'rules' => ['nullable','min:7'],
            ])
            ->add('password_confirmed', Field::PASSWORD, [
                'label'	=> 'Passwort wiederholen',
                'rules' => ['nullable','min:7'],
            ])
            ->add('senden', Field::BUTTON_SUBMIT, [
                'attr' => ['class' => 'btn btn-primary pull-right'],
            ])
        ;
    }
}
