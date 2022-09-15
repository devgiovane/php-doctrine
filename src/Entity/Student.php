<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\StudentRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity(repositoryClass: StudentRepository::class)]
#[ORM\Table(name: 'student')]
class Student
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    public int $id;

    #[ORM\OneToMany(
        mappedBy: "student", targetEntity: Phone::class, cascade: [ 'persist', 'remove' ], fetch: 'EAGER'
    )]
    private Collection $phones;

    #[ORM\ManyToMany(
        targetEntity: Course::class, inversedBy: "students"
    )]
    private Collection $courses;

    public function __construct(
        #[ORM\Column]
        private string $name
    )
    {
        $this->phones = new ArrayCollection();
        $this->courses = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Student
     */
    public function setName(string $name): Student
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Collection<Phone>
     */
    public function phones(): Collection
    {
        return $this->phones;
    }

    /**
     * @param Phone $phone
     * @return $this
     */
    public function addPhone(Phone $phone): Student
    {
        $this->phones->add($phone);
        $phone->setStudent($this);
        return $this;
    }

    /**
     * @return Collection<Course>
     */
    public function courses(): Collection
    {
        return $this->courses;
    }

    /**
     * @param Course $course
     * @return Student|null
     */
    public function enrollInCourse(Course $course): ?Student
    {
        if ($this->courses->contains($course)) {
            return null;
        }
        $this->courses->add($course);
        $course->addStudent($this);
        return $this;
    }
}
