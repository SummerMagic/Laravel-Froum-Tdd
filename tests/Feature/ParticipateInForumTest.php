<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ParticipateInForumTest extends TestCase
{
	use DatabaseMigrations;

	public function unauthenticated_user_may_no_add_replies()
	{
		$this->expectException('Illuminate\Auth\AuthenticationException');

		$this->post('threads/1/replies',[]);
	}

//	/** @test */
//	public function unauthenticated_user_may_no_add_replies()
//	{
//		$this->expectException('Illuminate\Auth\AuthenticationException');
//
//		$thread = factory('App\Thread')->create();
//
//		$reply = factory('App\Reply')->create();
//		$this->post($thread->path().'/replies',$reply->toArray());
//	}

	/** @test */
	function an_authenticated_user_may_participate_in_forum_threads()
	{
		// Given we have a authenticated user
		$this->be($user = factory('App\User')->create());
		// And an existing thread
		$thread = factory('App\Thread')->create();

		// When the user adds a reply to the thread
		$reply = factory('App\Reply')->make();
		$this->post($thread->path() .'/replies',$reply->toArray());

		// Then their reply should be visible on the page
		$this->get($thread->path())
			->assertSee($reply->body);
	}


}
