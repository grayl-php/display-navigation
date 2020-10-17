<?php

namespace Grayl\Display\Navigation\Entity;

use Grayl\Mixin\Common\Entity\FlatDataBag;

/**
 * Class NavigationLinkBag
 * The entity of a bag of NavigationLinks
 *
 * @package Grayl\Display\Navigation
 */
class NavigationLinkBag
{

    /**
     * An array of all NavigationLink entities in this bag
     *
     * @var FlatDataBag
     */
    private FlatDataBag $navigation_links;

    /**
     * The active NavigationLink entity
     *
     * @var ?NavigationLink
     */
    private ?NavigationLink $active_navigation_link = null;

    /**
     * The NavigationLink entity before the current active_navigation_link entity
     *
     * @var ?NavigationLink
     */
    private ?NavigationLink $previous_navigation_link = null;

    /**
     * The NavigationLink entity after the current active_navigation_link entity
     *
     * @var ?NavigationLink
     */
    private ?NavigationLink $next_navigation_link = null;


    /**
     * The class constructor
     */
    public function __construct()
    {

        // Create the FlatDataBag
        $this->navigation_links = new FlatDataBag();
    }


    /**
     * Puts a new NavigationLink entity into the bag of navigation_links
     *
     * @param NavigationLink $link The link entity to store
     */
    public function putNavigationLink(NavigationLink $link): void
    {

        // Store the link entity
        $this->navigation_links->putPiece($link);
    }


    /**
     * Returns the array of created link entities
     *
     * @return NavigationLink[]
     */
    public function getNavigationLinks(): array
    {

        // Return all link entities
        return $this->navigation_links->getPieces();
    }


    /**
     * Returns the active link entity
     *
     * @return ?NavigationLink
     */
    public function getActiveNavigationLink(): ?NavigationLink
    {

        // Return the active link
        return $this->active_navigation_link;
    }


    /**
     * Sets the active link entity
     *
     * @param ?NavigationLink $link The active link entity to set
     */
    public function setActiveNavigationLink(?NavigationLink $link): void
    {

        // Set the entity
        $this->active_navigation_link = $link;
    }


    /**
     * Gets the previous link entity
     *
     * @return NavigationLink
     */
    public function getPreviousNavigationLink(): ?NavigationLink
    {

        // Return the previous link entity
        return $this->previous_navigation_link;
    }


    /**
     * Sets the previous link entity
     *
     * @param ?NavigationLink $link The previous link entity to set
     */
    public function setPreviousNavigationLink(?NavigationLink $link): void
    {

        // Set the previous link entity
        $this->previous_navigation_link = $link;
    }


    /**
     * Gets the next link entity
     *
     * @return NavigationLink
     */
    public function getNextNavigationLink(): ?NavigationLink
    {

        // Return the next link entity
        return $this->next_navigation_link;
    }


    /**
     * Sets the next link entity
     *
     * @param ?NavigationLink $link The next entity to set
     */
    public function setNextNavigationLink(?NavigationLink $link): void
    {

        // Set the next link entity
        $this->next_navigation_link = $link;
    }

}