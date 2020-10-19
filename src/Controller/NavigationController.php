<?php

   namespace Grayl\Display\Navigation\Controller;

   use Grayl\Display\Navigation\Entity\NavigationLink;
   use Grayl\Display\Navigation\Entity\NavigationLinkBag;
   use Grayl\Display\Navigation\Service\NavigationService;

   /**
    * Class NavigationController
    * The controller for working with NavigationLink and NavigationLinkBag entities
    *
    * @package Grayl\Display\Navigation
    */
   class NavigationController
   {

      /**
       * The NavigationLinkBag instance to interact with
       *
       * @var NavigationLinkBag
       */
      private NavigationLinkBag $link_bag;

      /**
       * The NavigationService instance to interact with
       *
       * @var NavigationService
       */
      private NavigationService $navigation_service;


      /**
       * The class constructor
       *
       * @param NavigationLinkBag $link_bag           The NavigationLinkBag instance to control
       * @param NavigationService $navigation_service The NavigationService instance to use
       */
      public function __construct ( NavigationLinkBag $link_bag,
                                    NavigationService $navigation_service )
      {

         // Set the link bag
         $this->link_bag = $link_bag;

         // Set the service entity
         $this->navigation_service = $navigation_service;
      }


      /**
       * Adds a NavigationLink instance to the link bag
       *
       * @param NavigationLink $navigation_link A fully configured NavigationLink instance to add
       */
      public function putNavigationLink ( NavigationLink $navigation_link ): void
      {

         // Add the link into the bag
         $this->navigation_service->putNavigationLink( $this->link_bag,
                                                       $navigation_link );
      }


      /**
       * Returns the array of created link entities
       *
       * @return NavigationLink[]
       */
      public function getNavigationLinks (): array
      {

         // Return all link entities
         return $this->link_bag->getNavigationLinks();
      }


      /**
       * Gets the active link entity
       *
       * @return ?NavigationLink
       */
      public function getActiveNavigationLink (): ?NavigationLink
      {

         // Return the active link entity
         return $this->link_bag->getActiveNavigationLink();
      }


      /**
       * Sets the active, previous, and next navigation_links entities from the ID of the active link
       *
       * @param string $id The ID of the active link entity
       */
      public function setActiveNavigationLinkFromID ( string $id ): void
      {

         // Set the active link ID
         $this->navigation_service->setActiveNavigationLinkID( $this->link_bag,
                                                               $id );
      }


      /**
       * Gets the previous link entity
       *
       * @return ?NavigationLink
       */
      public function getPreviousNavigationLink (): ?NavigationLink
      {

         // Return the previous link entity
         return $this->link_bag->getPreviousNavigationLink();
      }


      /**
       * Gets the next link entity
       *
       * @return ?NavigationLink
       */
      public function getNextNavigationLink (): ?NavigationLink
      {

         // Return the next link entity
         return $this->link_bag->getNextNavigationLink();
      }

   }