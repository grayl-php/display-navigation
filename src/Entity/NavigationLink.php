<?php

   namespace Grayl\Display\Navigation\Entity;

   /**
    * Class NavigationLink
    * The entity of a single navigation link
    *
    * @package Grayl\Display\Navigation
    */
   class NavigationLink
   {

      /**
       * A unique ID for this link
       *
       * @var string
       */
      private string $id;

      /**
       * The URL of the link
       *
       * @var string
       */
      private string $url;

      /**
       * A display title
       *
       * @var string
       */
      private string $title;


      /**
       * The class constructor
       *
       * @param string $id    A unique ID for this link
       * @param string $url   The URL of the link
       * @param string $title A display title
       */
      public function __construct ( string $id,
                                    string $url,
                                    string $title )
      {

         // Set the class data
         $this->setID( $id );
         $this->setURL( $url );
         $this->setTitle( $title );
      }


      /**
       * Gets the ID
       *
       * @return string
       */
      public function getID (): string
      {

         // Return the ID
         return $this->id;
      }


      /**
       * Sets the ID
       *
       * @param string $id A unique ID for this link
       */
      public function setID ( string $id ): void
      {

         // Set the ID
         $this->id = $id;
      }


      /**
       * Gets the URL
       *
       * @return string
       */
      public function getURL (): string
      {

         // Return the URL
         return $this->url;
      }


      /**
       * Sets the URL
       *
       * @param string $url The URL of the link
       */
      public function setURL ( string $url ): void
      {

         // Set the URL
         $this->url = $url;
      }


      /**
       * Gets the title
       *
       * @return string
       */
      public function getTitle (): string
      {

         // Return the title
         return $this->title;
      }


      /**
       * Sets the display title
       *
       * @param string $title The display title for the link
       */
      public function setTitle ( string $title ): void
      {

         // Set the title
         $this->title = $title;
      }

   }