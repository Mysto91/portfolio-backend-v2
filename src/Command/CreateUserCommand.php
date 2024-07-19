<?php

declare(strict_types=1);

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

#[AsCommand(
    name: 'app:create-user',
    description: 'Creates a new user for authentification',
)]
class CreateUserCommand extends Command
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(
        UserPasswordHasherInterface $passwordHasher,
        EntityManagerInterface $entityManager,
        UserRepository $userRepository,
    ) {
        parent::__construct();

        $this->passwordHasher = $passwordHasher;
        $this->entityManager = $entityManager;
        $this->userRepository = $userRepository;
    }

    protected function configure(): void
    {
        $this
            ->setHelp('This command allows you to create a user.')
            ->addOption('username', 'u', InputOption::VALUE_REQUIRED, 'The username of the new user')
            ->addOption('password', 'p', InputOption::VALUE_REQUIRED, 'The password of the new user (will be hashed).')
            ->addOption('email', null, InputOption::VALUE_REQUIRED)
            ->addOption('role', 'r', InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY)
        ;
    }

    private function validate(InputInterface $input): array
    {
        $errors = [];

        $username = $input->getOption('username');

        if ($username === null) {
           $errors[] = 'Username is required.';
        }

        $userByUsername = $this->userRepository->findOneBy(['username' => $username]);

        if ($userByUsername !== null) {
            $errors[] = 'User with this username already exists.';
        }

        if ($input->getOption('password') === null) {
            $errors[] = 'Password is required.';
        }

        $email = $input->getOption('email');

        if ($input->getOption('email') === null) {
            $errors[] = 'Email is required.';
        }

        $userByEmail = $this->userRepository->findOneBy(['email' => $email]);

        if ($userByEmail !== null) {
            $errors[] = 'User with this email already exists.';
        }

        return $errors;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $errors = $this->validate($input);

        if (count($errors) > 0) {
            $io->error($errors);
            return Command::FAILURE;
        }

        $user = new User();
        $user->setUsername($input->getOption('username'))
            ->setEmail($input->getOption('email'))
            ->setRoles($input->getOption('role'));

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $input->getOption('password')
        );

        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);

        $this->entityManager->flush();

        $io->success('The user was created successfully.');

        return Command::SUCCESS;
    }
}
