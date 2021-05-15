<?php

namespace App\Entity\Sakila;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rental
 *
 * @ORM\Table(name="rental", uniqueConstraints={@ORM\UniqueConstraint(name="rental_date", columns={"rental_date", "inventory_id", "customer_id"})}, indexes={@ORM\Index(name="idx_fk_customer_id", columns={"customer_id"}), @ORM\Index(name="idx_fk_inventory_id", columns={"inventory_id"}), @ORM\Index(name="idx_fk_staff_id", columns={"staff_id"})})
 * @ORM\Entity
 */
class Rental
{
    /**
     * @var int
     *
     * @ORM\Column(name="rental_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $rentalId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rental_date", type="datetime", nullable=false)
     */
    private $rentalDate;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="return_date", type="datetime", nullable=true)
     */
    private $returnDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="last_update", type="datetime", nullable=false, options={"default"="CURRENT_TIMESTAMP"})
     */
    private $lastUpdate = 'CURRENT_TIMESTAMP';

    /**
     * @var \Customer
     *
     * @ORM\ManyToOne(targetEntity="Customer")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="customer_id", referencedColumnName="customer_id")
     * })
     */
    private $customer;

    /**
     * @var \Inventory
     *
     * @ORM\ManyToOne(targetEntity="Inventory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inventory_id", referencedColumnName="inventory_id")
     * })
     */
    private $inventory;

    /**
     * @var \Staff
     *
     * @ORM\ManyToOne(targetEntity="Staff")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="staff_id", referencedColumnName="staff_id")
     * })
     */
    private $staff;

    public function getRentalId(): ?int
    {
        return $this->rentalId;
    }

    public function getRentalDate(): ?\DateTimeInterface
    {
        return $this->rentalDate;
    }

    public function setRentalDate(\DateTimeInterface $rentalDate): self
    {
        $this->rentalDate = $rentalDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(?\DateTimeInterface $returnDate): self
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getLastUpdate(): ?\DateTimeInterface
    {
        return $this->lastUpdate;
    }

    public function setLastUpdate(\DateTimeInterface $lastUpdate): self
    {
        $this->lastUpdate = $lastUpdate;

        return $this;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

        return $this;
    }

    public function getInventory(): ?Inventory
    {
        return $this->inventory;
    }

    public function setInventory(?Inventory $inventory): self
    {
        $this->inventory = $inventory;

        return $this;
    }

    public function getStaff(): ?Staff
    {
        return $this->staff;
    }

    public function setStaff(?Staff $staff): self
    {
        $this->staff = $staff;

        return $this;
    }


}
