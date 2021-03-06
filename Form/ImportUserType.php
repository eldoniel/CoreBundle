<?php

/*
 * This file is part of the Claroline Connect package.
 *
 * (c) Claroline Consortium <consortium@claroline.net>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Claroline\CoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Claroline\CoreBundle\Validator\Constraints\CsvUser;
use Claroline\CoreBundle\Entity\Role;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ImportUserType extends AbstractType
{
    private $showRoles;

    public function __construct($showRoles = false)
    {
        $this->showRoles = $showRoles;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'file',
            'file',
            array(
                'required' => true,
                'mapped' => false,
                'constraints' => array(
                    new NotBlank(),
                    new File(),
                    new CsvUser()
                )
            )
        )
        ->add(
            'sendMail',
            'checkbox',
            array(
                'label' => 'send_mail',
                'required' => false
            )
        );

        if ($this->showRoles) {
            $builder->add(
                'role',
                'entity',
                array(
                    'required' => false,
                    'label' => 'roles',
                    'mapped' => false,
                    'class' => 'Claroline\CoreBundle\Entity\Role',
                    'expanded' => true,
                    'multiple' => false,
                    'property' => 'translationKey',
                    'query_builder' => function (\Doctrine\ORM\EntityRepository $er) {
                            $query = $er->createQueryBuilder('r')
                                ->where("r.type = " . Role::PLATFORM_ROLE)
                                ->andWhere("r.name != 'ROLE_ANONYMOUS'")
                                ->andWhere("r.name != 'ROLE_USER'");

                            return $query;
                        }
                )
            );
        }
    }

    public function getName()
    {
        return 'import_user_file';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver
        ->setDefaults(
            array(
                'translation_domain' => 'platform'
                )
        );
    }
}
