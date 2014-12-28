<?php
namespace Volleyball\Bundle\UserBundle\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends \Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand
{
    protected function configure()
    {
        $this
                ->setName('vb:user:create')
                ->setDescription('Create a user.')
                ->setDefinition(
                    array(
                        new InputArgument('username', InputArgument::REQUIRED, 'The username'),
                        new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                        new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                        new InputArgument('firstname', InputArgument::REQUIRED, 'The firstname'),
                        new InputArgument('lastname', InputArgument::REQUIRED, 'The lastname'),
                        new InputArgument('gender', InputArgument::REQUIRED, 'The gender'),
                        new InputArgument('birthdate', InputArgument::REQUIRED, 'The birthdate'),
                        new InputOption('super-admin', null, InputOption::VALUE_NONE, 'Set the user as super admin'),
                        new InputOption('inactive', null, InputOption::VALUE_NONE, 'Set the user as inactive'),
                        new InputArgument('type', InputArgument::REQUIRED, 'The user type'),
                    )
                )
                ->setHelp(<<<EOT
The <info>vb:user:create</info> command creates a user:
  <info>php app/console vb:user:create ner0tic</info>
This interactive shell will ask you for an email and then a password followed by a first and last name.
You can alternatively specify the email, password, first name, and last name as the second, third, fourth and fifth arguments:
  <info>php app/console vb:user:create ner0tic ner0tic@example.com mypassword john doe</info>
You can create a super admin via the super-admin flag:
  <info>php app/console vb:user:create admin --super-admin</info>
You can create an inactive user (will not be able to log in):
  <info>php app/console vb:user:create ghost --inactive</info>
EOT
        );
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $username   = $input->getArgument('username');
        $email      = $input->getArgument('email');
        $password   = $input->getArgument('password');
        $firstname  = $input->getArgument('firstname');
        $lastname   = $input->getArgument('lastname');
        $gender     = $input->getArgument('gender');
        $birthdate  = new \DateTime($input->getArgument('birthdate'));
        $type   = $input->getArgument('type');
        $inactive   = $input->getOption('inactive');
        $superadmin = $input->getOption('super-admin');
        
        $this
            ->getContainer()
            ->get('volleyball.user_manipulator')
            ->build(
                $username,
                $password,
                $email,
                $firstname,
                $lastname,
                $gender,
                $birthdate,
                $type,
                !$inactive,
                $superadmin
            );
        
        $output->writeln(sprintf('Created user <comment>%s (%s %s)</comment>', $username, $firstname, $lastname));
    }
    
    protected function interact(InputInterface $input, OutputInterface $output)
    {
        if (!$input->getArgument('username')) {
            $username = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose a username:',
                function ($username) {
                    if (empty($username)) {
                        throw new \Exception('Username can not be empty');
                    }
                    return $username;
                }
            );
            $input->setArgument('username', $username);
        }
        if (!$input->getArgument('email')) {
            $email = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please choose an email:',
                function ($email) {
                    if (empty($email)) {
                        throw new \Exception('Email can not be empty');
                    }
                    return $email;
                }
            );
            $input->setArgument('email', $email);
        }
        if (!$input->getArgument('password')) {
            $password = $this->getHelper('dialog')->askHiddenResponseAndValidate(
                $output,
                'Please choose a password:',
                function ($password) {
                    if (empty($password)) {
                        throw new \Exception('Password can not be empty');
                    }
                    return $password;
                }
            );
            $input->setArgument('password', $password);
        }
        
        if (!$input->getArgument('firstname')) {
            $firstname = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please enter a firstname:',
                function ($firstname) {
                    if (empty($firstname)) {
                        throw new \Exception('Firstname can not be empty');
                    }

                    return $firstname;
                }
            );
            $input->setArgument('firstname', $firstname);
        }
        
        if (!$input->getArgument('lastname')) {
            $lastname = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please enter a lastname:',
                function ($lastname) {
                    if (empty($lastname)) {
                        throw new \Exception('Lastname can not be empty');
                    }

                    return $lastname;
                }
            );
            $input->setArgument('lastname', $lastname);
        }
        
        if (!$input->getArgument('gender')) {
            $gender = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please enter a gender:',
                function ($gender) {
                    if (empty($gender)) {
                        throw new \Exception('Gender can not be empty');
                    } elseif (!in_array(strtolower($gender), array('m','f', 'male', 'female'))) {
                        throw new \Exception('Gender must be `m`, `f`, `male`, `female`.');
                    }

                    return $gender;
                }
            );
            $input->setArgument('gender', $gender);
        }
        
        if (!$input->getArgument('birthdate')) {
            $birthdate = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please enter a birthdate:',
                function ($birthdate) {
                    if (empty($birthdate)) {
                        throw new \Exception('Birthdate can not be empty');
                    } else if (!$birthdate instanceof \DateTime) {
                        $birthdate = new \DateTime($birthdate);
                    }

                    return $birthdate;
                }
            );
            $input->setArgument('birthdate', $birthdate);
        }
        
        if (!$input->getArgument('type')) {
            $type = $this->getHelper('dialog')->askAndValidate(
                $output,
                'Please enter a type (faculty, attendee, passel_leader):',
                function ($type) {
                    if (empty($type)) {
                        throw new \exception('User type can not be empty');
                    } elseif (!in_array($type, array('faculty', 'passel_leader', 'attendee'))) {
                        throw new \Exception('User type must be either: faculty, passel_leader, or attendee');
                    }
                    
                    return $type;
                }
            );
            $input->getArgument('type', $type);
        }
    }
}
