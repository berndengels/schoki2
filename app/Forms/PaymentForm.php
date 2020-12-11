<?php
/**
 * PaymentForm.php
 *
 * @author    Bernd Engels
 * @created   25.02.19 14:47
 * @copyright Bernd Engels
 */
namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;

class PaymentForm extends Form
{
    protected $formOptions = [
        'id'    => 'payment-form',
        'method' => 'POST',
        'url' => '/payment/create',
		'class' => 'mx-sm-1 mx-md-3 col-md-6',
    ];

    public function buildForm()
    {
        $paymentOptions = $this->getData('paymentOptions');
        $user = $this->getData('user');
        parent::buildForm();
        $this
            ->add('paymentMethods', Field::SELECT, [
				'label'	=> 'Zahlungsart',
                'empty_value'  => 'Bitte wählen ...',
                'choices' => $paymentOptions,
                'attr'	=> [
                    'id' => 'paymentMethods',
                ]
			])
            ->add('name', Field::TEXT, [
                'rules' => ['required','max:50'],
                'value' => $user ? $user->name : null,
                'attr'	=> [
                    'id' => 'name',
                    'placeholder'   => 'Name',
                ]
            ])
            ->add('email', Field::EMAIL, [
                'rules' => ['required','email'],
                'value' => $user ? $user->email : null,
                'attr'	=> [
                    'id' => 'email',
                    'placeholder'   => 'Email Adresse',
                ]
            ])
            ->add('senden', Field::BUTTON_SUBMIT, [
                'attr' => [
                    'class' => 'btn btn-primary pull-right',
                    'id'   => 'btnSubmit',
                    'style' => 'display:none',
                ],
            ])
        ;
    }
}
