<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;


#[ORM\Entity]
#[ORM\Table(name: 'course')]
class Course
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    public int $id;

    #[ORM\ManyToMany(
        targetEntity: Student::class, mappedBy: "courses"
    )]
    private Collection $students;

    public function __construct(
        #[ORM\Column]
        public readonly string $name
    )
    {
        $this->students = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Collection<Student>
     */
    public function students(): Collection
    {
        return $this->students;
    }

    /**
     * @param Student $student
     * @return Course|null
     */
    public function addStudent(Student $student): ?Course
    {
        if ($this->students->contains($student)) {
            return null;
        }
        $this->students->add($student);
        $student->enrollInCourse($this);
        return $this;
    }
}
