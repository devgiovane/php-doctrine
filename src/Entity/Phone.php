<?php


namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
#[ORM\Table(name: 'phone')]
class Phone
{
    #[ORM\Id, ORM\Column, ORM\GeneratedValue]
    private int $id;

    #[ORM\ManyToOne(
        targetEntity: Student::class, inversedBy: "phones"
    )]
    public readonly Student $student;

    public function __construct(
        #[ORM\Column]
        private string $number
    )
    {
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @param string $number
     * @return Phone
     */
    public function setNumber(string $number): Phone
    {
        $this->number = $number;
        return $this;
    }

    /**
     * @param Student $student
     * @return $this
     */
    public function setStudent(Student $student): Phone
    {
        $this->student = $student;
        return $this;
    }
}
