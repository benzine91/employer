<?php

namespace App\Test\Controller;

use App\Entity\Employer;
use App\Repository\EmployerRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmployerControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EmployerRepository $repository;
    private string $path = '/employer/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Employer::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Employer index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'employer[prenom]' => 'Testing',
            'employer[nom]' => 'Testing',
            'employer[telephone]' => 'Testing',
            'employer[email]' => 'Testing',
            'employer[adresse]' => 'Testing',
            'employer[poste]' => 'Testing',
            'employer[salaire]' => 'Testing',
            'employer[dateDeNaissance]' => 'Testing',
        ]);

        self::assertResponseRedirects('/employer/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Employer();
        $fixture->setPrenom('My Title');
        $fixture->setNom('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setPoste('My Title');
        $fixture->setSalaire('My Title');
        $fixture->setDateDeNaissance('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Employer');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Employer();
        $fixture->setPrenom('My Title');
        $fixture->setNom('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setPoste('My Title');
        $fixture->setSalaire('My Title');
        $fixture->setDateDeNaissance('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'employer[prenom]' => 'Something New',
            'employer[nom]' => 'Something New',
            'employer[telephone]' => 'Something New',
            'employer[email]' => 'Something New',
            'employer[adresse]' => 'Something New',
            'employer[poste]' => 'Something New',
            'employer[salaire]' => 'Something New',
            'employer[dateDeNaissance]' => 'Something New',
        ]);

        self::assertResponseRedirects('/employer/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getPrenom());
        self::assertSame('Something New', $fixture[0]->getNom());
        self::assertSame('Something New', $fixture[0]->getTelephone());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getAdresse());
        self::assertSame('Something New', $fixture[0]->getPoste());
        self::assertSame('Something New', $fixture[0]->getSalaire());
        self::assertSame('Something New', $fixture[0]->getDateDeNaissance());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Employer();
        $fixture->setPrenom('My Title');
        $fixture->setNom('My Title');
        $fixture->setTelephone('My Title');
        $fixture->setEmail('My Title');
        $fixture->setAdresse('My Title');
        $fixture->setPoste('My Title');
        $fixture->setSalaire('My Title');
        $fixture->setDateDeNaissance('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/employer/');
    }
}
