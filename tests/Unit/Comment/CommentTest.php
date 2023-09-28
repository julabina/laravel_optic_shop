<?php

namespace Test\Unit;

use App\Models\Comment;
use App\Models\Product;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;

it('store new comment', function () {
    $product = Product::factory()->create();
    $user = User::factory()->create();

    $response = actingAs($user)
        ->post(
            uri: route('comment.store', ['cat' => 'telescope', 'id' => $product->id]),
            data: [
                'content' => 'comment test',
            ]
        );

    $response
        ->assertRedirectToRoute('product.show', ['cat' => 'telescope', 'id' => $product->id]);

    assertDatabaseCount('comments', 1);

    $comment = Comment::first();

    expect($comment->content)->toBe('comment test');
    expect($comment->user_id)->toBe($user->id);
    expect($comment->product_id)->toBe($product->id);
});

it('delete comment', function () {
    $product = Product::factory()->create();
    $user = User::factory()->create();
    $comment = Comment::factory()->create([
        'product_id' => $product->id,
        'user_id' => $user->id,
    ]);

    $response = actingAs($user)
        ->delete(
            uri: route('comment.delete', ['cat' => 'telescope', 'id' => $comment->id]),
        );

    $response
        ->assertRedirectToRoute('product.show', ['cat' => 'telescope', 'id' => $product->id]);

    assertDatabaseCount('comments', 0);
});

it('delete comment when comment user is not current user', function () {
    $product = Product::factory()->create();
    $user = User::factory()->create();
    $comment = Comment::factory()->create([
        'product_id' => $product->id,
        'user_id' => $user->id,
    ]);

    $response = actingAs(User::factory()->create())
        ->delete(
            uri: route('comment.delete', ['cat' => 'telescope', 'id' => $comment->id]),
        );

    $response
        ->assertRedirectToRoute('product.show', ['cat' => 'telescope', 'id' => $product->id]);

    assertDatabaseCount('comments', 1);
});

it('update comment', function () {
    $product = Product::factory()->create();
    $user = User::factory()->create();
    $comment = Comment::factory()->create([
        'product_id' => $product->id,
        'user_id' => $user->id,
        'content' => 'Lorem ipsum',
    ]);

    $newContent = 'Modified text';

    $response = actingAs($user)
        ->put(
            uri: route('comment.edit', ['cat' => 'telescope', 'id' => $comment->id]),
            data: [
                'content' => $newContent,
            ]
        );

    $response
        ->assertRedirectToRoute('product.show', ['cat' => 'telescope', 'id' => $product->id]);

    $commentModified = Comment::find($comment->id);

    expect($commentModified->content)->toBe($newContent);
});

it('update comment when comment user is not current user', function () {
    $product = Product::factory()->create();
    $user = User::factory()->create();
    $comment = Comment::factory()->create([
        'product_id' => $product->id,
        'user_id' => $user->id,
        'content' => 'Lorem ipsum',
    ]);

    $newContent = 'Modified text';

    $response = actingAs(User::factory()->create())
        ->put(
            uri: route('comment.edit', ['cat' => 'telescope', 'id' => $comment->id]),
            data: [
                'content' => $newContent,
            ]
        );

    $response
        ->assertRedirectToRoute('product.show', ['cat' => 'telescope', 'id' => $product->id]);

    $commentModified = Comment::find($comment->id);

    expect($commentModified->content)->toBe($comment->content);
});
