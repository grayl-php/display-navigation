<?php

   namespace Grayl\Display\Navigation;

   use Grayl\Display\Navigation\Controller\NavigationController;
   use Grayl\Display\Navigation\Entity\NavigationLink;
   use Grayl\Display\Navigation\Entity\NavigationLinkBag;
   use Grayl\Display\Navigation\Service\NavigationService;
   use Grayl\Mixin\Common\Traits\StaticTrait;

   /**
    * Front-end for the Navigation package
    *
    * @package Grayl\Display\Navigation
    */
   class NavigationPorter
   {

      // Use the static instance trait
      use StaticTrait;

      /**
       * Creates a new NavigationController
       *
       * @return NavigationController
       */
      public function newNavigationController (): NavigationController
      {

         // Return the controller
         return new NavigationController( new NavigationLinkBag(),
                                          new NavigationService() );
      }


      /**
       * Creates a new NavigationLink instance
       *
       * @param string $id    A unique ID
       * @param string $url   The URL of the link
       * @param string $title A display title
       *
       * @return NavigationLink
       */
      public function newNavigationLink ( string $id,
                                          string $url,
                                          string $title ): NavigationLink
      {

         // Return a new NavigationLink
         return new NavigationLink( $id,
                                    $url,
                                    $title );
      }

   }