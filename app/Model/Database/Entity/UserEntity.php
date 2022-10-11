<?php declare(strict_types = 1);

namespace App\Model\Database\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class UserEntity
{

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer", nullable=false)
	 */
	protected int $id;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected string $nickname;

	/**
	 * @ORM\Column(type="string", nullable=false)
	 */
	protected string $password;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected ?string $forename;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected ?string $surname;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected ?string $number;


	public function setId(int $id): void
	{
		$this->id = $id;
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getNickname(): string
	{
		return $this->nickname;
	}


	public function setNickname(string $nickname): void
	{
		$this->nickname = $nickname;
	}


	public function getPassword(): string
	{
		return $this->password;
	}


	public function setPassword(string $password): void
	{
		$this->password = $password;
	}


	public function getForename(): ?string
	{
		return $this->forename;
	}


	public function setForename(?string $forename): void
	{
		$this->forename = $forename;
	}


	public function getSurname(): ?string
	{
		return $this->surname;
	}


	public function setSurname(?string $surname): void
	{
		$this->surname = $surname;
	}


	public function getNumber(): ?string
	{
		return $this->number;
	}


	public function setNumber(?string $number): void
	{
		$this->number = $number;
	}

}
