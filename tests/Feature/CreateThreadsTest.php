<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
	use DatabaseMigrations;
    /**
     * test
     */

    function gest_user_can_create_form_threads()
    {
    	$this->expectException('Illuminate\Auth\AuthenticationException');
	    $thread = factory('App\Thread')->make();
	    $this->post('/threads',$thread->toArray());

    }


    function an_authenticated_user_can_create_new_forum_threads()
    {
    	$this->actingAs(factory('App\User')->create());

    	$thread = factory('App\Thread')->make();

    	$this->post('/threads',$thread->toArray());

    	$this->get($thread->path())
    	     ->assertSee($thread->title)
		     ->assertSee($thread->body);

    }

}
