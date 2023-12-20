<?php   
  namespace App\Classes;
  class User 
  {
      private ?int $id;
      private ?string $fname ;
      private ?string $lname;
      private ?string $email;
      private ?string $mobileNumber;
      private ?string $creationDate;
      private ?int $ville_id;
      private ?string $address;
    
      
      public function __construct(
          int $id,
          ?string $fname,
          ?string $lname,
          ?string $mobileNumber,
          ?string $email,
          ?string $address,
          ?string $creationDate,
          ?int $ville_id
      ) {
          $this->id = $id;
          $this->fname = $fname;
          $this->lname = $lname;
          $this->email = $email;
          $this->mobileNumber = $mobileNumber;
          $this->creationDate = $creationDate;
          $this->ville_id = $ville_id;
          $this->address = $address;
      }
  
      public function getId(): int
      {
          return $this->id;
      }
  
      public function setId(int $id): void
      {
          $this->id = $id;
      }
  
      public function getFname(): ?string
      {
          return $this->fname;
      }
  
      public function setFname(?string $fname): void
      {
          $this->fname = $fname;
      }
  
      public function getLname(): ?string
      {
          return $this->lname;
      }
  
      public function setLname(?string $lname): void
      {
          $this->lname = $lname;
      }
  
      public function getEmail(): ?string
      {
          return $this->email;
      }
  
      public function setEmail(?string $email): void
      {
          $this->email = $email;
      }
  
      public function getMobileNumber(): ?string
      {
          return $this->mobileNumber;
      }
  
      public function setMobileNumber(?string $mobileNumber): void
      {
          $this->mobileNumber = $mobileNumber;
      }
  
      public function getCreationDate(): ?string
      {
          return $this->creationDate;
      }
  
      public function setCreationDate(?string $creationDate): void
      {
          $this->creationDate = $creationDate;
      }
  
      public function getVilleId(): ?int
      {
          return $this->ville_id;
      }
  
      public function setVilleId(?int $ville_id): void
      {
          $this->ville_id = $ville_id;
      }
  
      public function getAddress(): ?string
      {
          return $this->address;
      }
  
      public function setAddress(?string $address): void
      {
          $this->address = $address;
      }
  }