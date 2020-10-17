<?php

namespace Grayl\Test\Display\Navigation;

use Grayl\Display\Navigation\Controller\NavigationController;
use Grayl\Display\Navigation\Entity\NavigationLink;
use Grayl\Display\Navigation\NavigationPorter;
use PHPUnit\Framework\TestCase;

/**
 * Test class for the Navigation package
 *
 * @package Grayl\Display\Navigation
 */
class NavigationControllerTest extends
    TestCase
{

    /**
     * Tests the creation of a NavigationController object
     *
     * @return NavigationController
     */
    public function testCreateNavigationController(): NavigationController
    {

        // Create a NavigationController
        $navigation = NavigationPorter::getInstance()
            ->newNavigationController();

        // Check the type of object created
        $this->assertInstanceOf(
            NavigationController::class,
            $navigation
        );

        // Add navigation_links for testing
        $navigation->putNavigationLink(
            NavigationPorter::getInstance()
                ->newNavigationLink(
                    "index1",
                    "/index1.php",
                    "Index 1"
                )
        );
        $navigation->putNavigationLink(
            NavigationPorter::getInstance()
                ->newNavigationLink(
                    "index2",
                    "/index2.php",
                    "Index 2"
                )
        );
        $navigation->putNavigationLink(
            NavigationPorter::getInstance()
                ->newNavigationLink(
                    "index3",
                    "/index3.php",
                    "Index 3"
                )
        );
        $navigation->putNavigationLink(
            NavigationPorter::getInstance()
                ->newNavigationLink(
                    "index4",
                    "/index4.php",
                    "Index 4"
                )
        );

        // Return it
        return $navigation;
    }


    /**
     * Tests the active link handling of a NavigationController
     *
     * @param NavigationController $navigation A NavigationController entity to test
     *
     * @depends testCreateNavigationController
     */
    public function testNavigationControllerActiveLink(
        NavigationController $navigation
    ): void {

        // Set the active link
        $navigation->setActiveNavigationLinkFromID('index3');

        // Get active link
        $active_link = $navigation->getActiveNavigationLink();

        // Check the type of object returned
        $this->assertInstanceOf(
            NavigationLink::class,
            $active_link
        );

        // Test the link data
        $this->assertIsString($active_link->getID());
        $this->assertEquals(
            'index3',
            $active_link->getID()
        );
        $this->assertNotNull($active_link->getURL());
        $this->assertNotNull($active_link->getTitle());
    }


    /**
     * Tests the previous link handling of a NavigationController
     *
     * @param NavigationController $navigation A NavigationController entity to test
     *
     * @depends testCreateNavigationController
     */
    public function testNavigationControllerPreviousLink(
        NavigationController $navigation
    ): void {

        // Set the active link
        $navigation->setActiveNavigationLinkFromID('index3');

        // Grab the previous link
        $previous_link = $navigation->getPreviousNavigationLink();

        // Check the type of object returned
        $this->assertInstanceOf(
            NavigationLink::class,
            $previous_link
        );

        // Test the entity data
        $this->assertIsString($previous_link->getID());
        $this->assertEquals(
            'index2',
            $previous_link->getID()
        );
    }


    /**
     * Tests the next link handling of a NavigationController
     *
     * @param NavigationController $navigation A NavigationController entity to test
     *
     * @depends testCreateNavigationController
     */
    public function testNavigationControllerNextLink(
        NavigationController $navigation
    ): void {

        // Set the active link
        $navigation->setActiveNavigationLinkFromID('index3');

        // Grab the next link
        $next_link = $navigation->getNextNavigationLink();

        // Check the type of object returned
        $this->assertInstanceOf(
            NavigationLink::class,
            $next_link
        );

        // Test the entity data
        $this->assertIsString($next_link->getID());
        $this->assertEquals(
            'index4',
            $next_link->getID()
        );
    }


    /**
     * Tests the handling of the first link in the set
     * Should return no previous link
     *
     * @param NavigationController $navigation A NavigationController entity to test
     *
     * @depends testCreateNavigationController
     */
    public function testNavigationControllerFirstLink(
        NavigationController $navigation
    ): void {

        // Set the active link
        $navigation->setActiveNavigationLinkFromID('index1');

        // Grab the previous link
        $previous_link = $navigation->getPreviousNavigationLink();

        // Make sure it was blank
        $this->assertNotInstanceOf(
            NavigationLink::class,
            $previous_link
        );
        $this->assertNull($previous_link);
    }


    /**
     * Tests the handling of the last link in the set
     * Should return no next link
     *
     * @param NavigationController $navigation A NavigationController entity to test
     *
     * @depends testCreateNavigationController
     */
    public function testNavigationControllerLastLink(
        NavigationController $navigation
    ): void {

        // Set the active link
        $navigation->setActiveNavigationLinkFromID('index4');

        // Grab the next link
        $next_link = $navigation->getNextNavigationLink();

        // Make sure it was blank
        $this->assertNotInstanceOf(
            NavigationLink::class,
            $next_link
        );
        $this->assertNull($next_link);
    }

}
