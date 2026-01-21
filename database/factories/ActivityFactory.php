<?php

namespace Database\Factories;

use App\Models\Activity;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Activity>
 */
class ActivityFactory extends Factory
{
    protected $model = Activity::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['project', 'event', 'campaign', 'program'];
        $statuses = ['planned', 'ongoing', 'completed'];
        $categories = ['Éducation', 'Santé', 'Environnement', 'Humanitaire', 'Développement', 'Urgence', 'Soutien aux familles', 'Enfants'];
        $countries = ['Belgique', 'Congo', 'Rwanda', 'Burundi', 'France', 'Sénégal', 'Mali', 'Burkina Faso'];
        
        $startDate = fake()->dateTimeBetween('-1 year', '+6 months');
        $budget = fake()->numberBetween(5000, 100000);
        $amountRaised = fake()->numberBetween(0, min($budget, $budget * 0.9));
        
        // Images en ligne variées (pexels, unsplash, etc.)
        $images = [
            'https://images.pexels.com/photos/933964/pexels-photo-933964.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/1367272/pexels-photo-1367272.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/2255935/pexels-photo-2255935.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/3184460/pexels-photo-3184460.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/3807277/pexels-photo-3807277.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/3861445/pexels-photo-3861445.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/417074/pexels-photo-417074.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/159775/library-la-trobe-study-students-159775.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/2566581/pexels-photo-2566581.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/1309766/pexels-photo-1309766.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/1024311/pexels-photo-1024311.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/2081199/pexels-photo-2081199.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/2425011/pexels-photo-2425011.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/159306/construction-site-build-construction-work-159306.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/247431/pexels-photo-247431.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/1072824/pexels-photo-1072824.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/1428787/pexels-photo-1428787.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/3184302/pexels-photo-3184302.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/3184339/pexels-photo-3184339.jpeg?auto=compress&cs=tinysrgb&w=800',
            'https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=800',
        ];

        return [
            'title' => fake()->sentence(4),
            'description' => fake()->paragraphs(3, true),
            'short_description' => fake()->sentence(10),
            'type' => fake()->randomElement($types),
            'category' => fake()->randomElement($categories),
            'tags' => fake()->words(3, false),
            'start_date' => $startDate,
            'end_date' => fake()->optional()->dateTimeBetween($startDate, '+1 year'),
            'location' => fake()->city(),
            'country' => fake()->randomElement($countries),
            'budget' => $budget,
            'amount_raised' => $amountRaised,
            'amount_spent' => fake()->numberBetween(0, min($amountRaised, $amountRaised * 0.8)),
            'status' => fake()->randomElement($statuses),
            'is_featured' => fake()->boolean(30), // 30% de chance d'être en vedette
            'is_public' => true,
            'include_in_reports' => true,
            'image' => fake()->randomElement($images),
            'images' => [fake()->randomElement($images), fake()->randomElement($images)],
            'video_url' => fake()->optional()->url(),
            'results' => fake()->optional()->paragraphs(2, true),
            'impact' => fake()->optional()->paragraphs(2, true),
            'beneficiaries_count' => fake()->numberBetween(10, 5000),
            'impact_metrics' => [
                'families_helped' => fake()->numberBetween(5, 500),
                'children_educated' => fake()->numberBetween(10, 1000),
                'meals_provided' => fake()->numberBetween(100, 10000),
            ],
            'views_count' => fake()->numberBetween(0, 5000),
            'likes_count' => fake()->numberBetween(0, 500),
            'notes' => fake()->optional()->sentence(),
        ];
    }

    /**
     * Indicate that the activity should be featured.
     */
    public function featured(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_featured' => true,
        ]);
    }

    /**
     * Indicate that the activity should be ongoing.
     */
    public function ongoing(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'ongoing',
            'start_date' => now()->subMonths(fake()->numberBetween(1, 6)),
            'end_date' => now()->addMonths(fake()->numberBetween(3, 12)),
        ]);
    }

    /**
     * Indicate that the activity should be completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'start_date' => now()->subMonths(fake()->numberBetween(6, 24)),
            'end_date' => now()->subMonths(fake()->numberBetween(1, 6)),
            'amount_raised' => $attributes['budget'] ?? fake()->numberBetween(5000, 100000),
        ]);
    }
}
