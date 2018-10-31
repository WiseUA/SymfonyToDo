<?php
// src/Entity/User.php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use FOS\UserBundle\Model\User as BaseUser;
use FOS\UserBundle\Model\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @ApiResource(
 *     normalizationContext={"groups"={"user", "user:read"}},
 *     denormalizationContext={"groups"={"user", "user:write"}}
 * )
 */
class User extends BaseUser {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @Groups({"user"})
   */
  protected $email;

  /**
   * @ORM\Column(type="string", length=255, nullable=true)
   * @Groups({"user"})
   */
  protected $fullname;

  /**
   * @Groups({"user:write"})
   */
  protected $plainPassword;

  /**
   * @Groups({"user:write"})
   */
  protected $enabled;

  /**
   * @Groups({"user"})
   */
  protected $username;


  public function __construct() {
    parent::__construct();
    $this->tasks = new ArrayCollection();
    // your own logic
  }


  public function setFullname(?string $fullname): void {
    $this->fullname = $fullname;
  }

  public function getFullname(): ?string {
    return $this->fullname;
  }

  public function isUser(?UserInterface $user = NULL): bool {
    return $user instanceof self && $user->id === $this->id;
  }

  /**
   * @ORM\OneToMany(targetEntity="App\Entity\Task", mappedBy="user")
   */
  private $tasks;

  /**
   * @return Collection|Task[]
   */
  public function getTasks(): Collection {
    return $this->tasks;
  }

  public function addTask(Task $task): self {
    if (!$this->tasks->contains($task)) {
      $this->tasks[] = $task;
      $task->setUser($this);
    }

    return $this;
  }

  public function removeTask(Task $task): self {
    if ($this->tasks->contains($task)) {
      $this->tasks->removeElement($task);
      // set the owning side to null (unless already changed)
      if ($task->getUser() === $this) {
        $task->setUser(NULL);
      }
    }

    return $this;
  }
}