<?php

   namespace Grayl\Display\Navigation\Service;

   use Grayl\Display\Navigation\Entity\NavigationLink;
   use Grayl\Display\Navigation\Entity\NavigationLinkBag;

   /**
    * Class NavigationService
    * The service for working with NavigationLinkBags
    *
    * @package Grayl\Display\Navigation
    */
   class NavigationService
   {

      /**
       * Places a new NavigationLink entity into the bag, and resets the pointers
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       * @param NavigationLink    $link     The NavigationLink entity to add into the bag
       */
      public function putNavigationLink ( NavigationLinkBag $link_bag,
                                          NavigationLink $link ): void
      {

         // Save the link entity into the bag
         $link_bag->putNavigationLink( $link );

         // Recalculate the next/prev navigation_links
         $this->calculateNextPrevNavigationLinks( $link_bag );
      }


      /**
       * Resets all pointers in the NavigationLinkBag
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       *
       * @return void
       */
      public function resetNavigationLinkBagPointers ( NavigationLinkBag $link_bag ): void
      {

         // Reset all link pointers
         $link_bag->setActiveNavigationLink( null );
         $link_bag->setPreviousNavigationLink( null );
         $link_bag->setNextNavigationLink( null );
      }


      /**
       * Returns the current active link's ID
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       *
       * @return string
       */
      public function getActiveNavigationLinkID ( NavigationLinkBag $link_bag ): ?string
      {

         // Get the active link entity from the bag
         $link = $link_bag->getActiveNavigationLink();

         // If we don't have an active link, exit the routine
         if ( ! empty( $link ) ) {
            return $link->getID();
         }

         // No active link
         return null;
      }


      /**
       * Sets the active, previous, and next navigation_links entities on a link bag using the ID of the active link
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       * @param string            $id       The ID of the active link entity
       */
      public function setActiveNavigationLinkID ( NavigationLinkBag $link_bag,
                                                  string $id ): void
      {

         // Find the active link entity by its ID
         $active_link = $this->findNavigationLinkFromID( $link_bag,
                                                         $id );

         // Set the new reference
         $link_bag->setActiveNavigationLink( $active_link );

         // Determine the next / prev entities
         $this->calculateNextPrevNavigationLinks( $link_bag );
      }


      /**
       * Determines the previous and next link entities based on the currently active link
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       */
      public function calculateNextPrevNavigationLinks ( NavigationLinkBag $link_bag ): void
      {

         // Get the active link ID
         $id = $this->getActiveNavigationLinkID( $link_bag );

         // If there is no active link, reset the bag
         if ( empty( $id ) ) {
            $this->resetNavigationLinkBagPointers( $link_bag );

            return;
         }

         // Find the next, and previous link entities using the active link ID
         $previous_link = $this->findPreviousNavigationLink( $link_bag,
                                                             $id );
         $next_link     = $this->findNextNavigationLink( $link_bag,
                                                         $id );

         // Set the new references
         $link_bag->setPreviousNavigationLink( $previous_link );
         $link_bag->setNextNavigationLink( $next_link );
      }


      /**
       * Finds a link entity in the bag by using its ID
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       * @param string            $id       The ID of the link entity to find
       *
       * @return NavigationLink
       */
      private function findNavigationLinkFromID ( NavigationLinkBag $link_bag,
                                                  string $id ): ?NavigationLink
      {

         // Loop through each entity in the bag and check its ID
         foreach ( $link_bag->getNavigationLinks() as $link ) {
            // See if the ID matches the one we are searching for
            if ( $link->getID() == $id ) {
               return $link;
            }
         }

         // No match
         return null;
      }


      /**
       * Finds the link entity located before a specific link ID
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       * @param ?string           $id       The ID of the current link entity
       *
       * @return NavigationLink
       */
      private function findPreviousNavigationLink ( NavigationLinkBag $link_bag,
                                                    ?string $id ): ?NavigationLink
      {

         // Set a blank previous link instance
         $previous_link = null;

         // Loop through each entity in the bag and check its ID
         foreach ( $link_bag->getNavigationLinks() as $link ) {
            // See if the ID matches the active one
            if ( $link->getID() == $id ) {
               return $previous_link;
            }

            // Set this link entity as the previous instance for the next loop
            $previous_link = $link;
         }

         // No match
         return null;
      }


      /**
       * Finds the link instance after a specific link ID
       *
       * @param NavigationLinkBag $link_bag The NavigationLinkBag instance to use
       * @param ?string           $id       The ID of the current link entity
       *
       * @return NavigationLink
       */
      private function findNextNavigationLink ( NavigationLinkBag $link_bag,
                                                ?string $id ): ?NavigationLink
      {

         // Set a blank ID
         $previous_id = null;

         // Loop through each entity in the bag and check its ID
         foreach ( $link_bag->getNavigationLinks() as $link ) {
            // See if the ID matches the passed ID
            if ( $previous_id == $id ) {
               return $link;
            }

            // Set this link entity's ID  for the next loop
            $previous_id = $link->getID();
         }

         // No match
         return null;
      }

   }