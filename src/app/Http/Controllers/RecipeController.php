<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    protected $table = "tb_recipe";

    /**
     * R1011: /recipe/{recipeId}
     *
     * @return \Illuminate\Http\Response
     */
    public function view($recipeId)
    {
        // TODO get data from model
        $data = [
            "name" => "Classic Tiramisu",
            "id" => 1,
            "score" => 3.2,
            "nRatings" => 34,
            "tags" => [
                [
                    "id" => 1,
                    "name" => "Vegetarian"
                ]
            ],
            "owner" => [
                "id" => 2,
                "username" => "jamieoliver",
                "name" => "Jamie Oliver"
            ],
            "suggested" => [
                [
                    "id" => 1,
                    "name" => "Basic Brown Sugar Meringue",
                    "owner" => "Emma Watson",
                    "image" => "https://www.thespruceeats.com/thmb/F1ebSCX8WuGCeEhkdsoyMMvmaFE=/960x0/filters:no_upscale():max_bytes(150000):strip_icc():format(webp)/brown-sugar-meringue-for-pies-3056204-hero-01-3ea7e126fc034c9c9ca69e8d7ddba9e2.jpg",
                    "score" => 4.6,
                    "nReviews" => 104
                ]
            ],
            "servings" => 3,
            "description" => "Classic Italian dessert made with ladyfingers and mascarpone cheese. It can be made in a trifle bowl or a springform pan.",
            "difficulty" => "medium",
            "ingredients" => [
                "egg yolks" => "<span class=\"number\">6</span>",
                "white sugar" => "<span class=\"number\">1.25</span> cups",
                "mascarpone cheese" => "<span class=\"number\">1.25</span> cups",
                "heavy whipping cream" => "<span class=\"number\">1.75</span> cups",
                "coffee flavored liqueur" => "<span class=\"number\">0.33</span> cup",
                "ladyfingers" => "<span class=\"number\">12</span> ounce",
                "unsweetened cocoa powder" => "<span class=\"number\">1</span> teaspoon",
                "square semisweet chocolate" => "<span class=\"number\">1</span> ounce",
            ],
            "method" => [
                "Step 1" => [
                    "text" => "Combine egg yolks and sugar in the top of a double boiler, over boiling water. Reduce heat to low, and cook for about 10 minutes, stirring constantly. Remove from heat and whip yolks until thick and lemon colored.",
                    "image" => "https://cdn.sallysbakingaddiction.com/wp-content/uploads/2019/06/tiramisu-cream-400x400.jpg"
                ],
                "Step 2" => [
                    "text" => "Add mascarpone to whipped yolks. Beat until combined. In a separate bowl, whip cream to stiff peaks. Gently fold into yolk mixture and set aside.",
                ],
                "Step 3" => [
                    "text" => "Split the lady fingers in half, and line the bottom and sides of a large glass bowl. Brush with coffee liqueur. Spoon half of the cream filling over the lady fingers. Repeat ladyfingers, coffee liqueur and filling layers. Garnish with cocoa and chocolate curls. Refrigerate several hours or overnight.",
                    "image" => "https://cdn.sallysbakingaddiction.com/wp-content/uploads/2019/06/ladyfingers-for-tiramisu-400x400.jpg"
                ],
                "Step 4" => [
                    "text" => "To make the chocolate curls, use a vegetable peeler and run it down the edge of the chocolate bar.",
                ]
            ],
            "comments" => [
                [
                    "user" => "The Master Critic of Foods",
                    "comment" => "Needs more salt!",
                    "rate" => 3,
                    "post" => "2 days ago",
                    "edit" => "3 mins ago",
                    "replies" => [
                        [
                            "user" => "High Cholesterol Man",
                            "comment" => "I think it has more salt than needed.",
                            "post" => "2 hours ago",
                            "replies" => [
                                [
                                    "user" => "The Master Critic of Foods",
                                    "comment" => "How dare you question the Master Critic! I know better!",
                                    "post" => "now",
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "user" => "The Food Lover",
                    "comment" => "I loved it!",
                    "post" => "5 days ago",
                ]
            ]
        ];

        return view('pages.recipe', $data);
    }

    /**
     * R1012: /recipe
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * RX: /recipe/{recipeId}/edit
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function edit($recipeId)
    {
        //
    }

    /**
     * R2101: /api/recipe
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        //
    }

    /**
     * R2102: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function select($recipeId)
    {

    }

    /**
     * R2103: /api/recipe/{recipeId}
     *
     * @param \Illuminate\Http\Request $request
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $recipeId)
    {
        //
    }

    /**
     * R2104: /api/recipe/{recipeId}
     *
     * @param int $recipeId
     * @return \Illuminate\Http\Response
     */
    public function delete($recipeId)
    {
        //
    }
}
