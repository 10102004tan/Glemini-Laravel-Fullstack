<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Quizz
        DB::table('quizzes')->insert(
            [
                'title' => 'Thành phố ở Việt Nam',
                'description' => 'No Description'
            ]
        );

        // Create Question For Quizz
        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?', 
                'image' => 'images/ho-chi-minh.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 1,
                'content' => 'Thành phố Hồ Chí Minh', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 1,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 1,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 1,
                'content' => 'Tỉnh Cần Thơ', 
                'is_correct' => 0
            ]
        );
        
        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?', 
                'image' => 'images/ha-noi.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 2,
                'content' => 'Thành phố Hồ Chí Minh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 2,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 2,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 2,
                'content' => 'Tỉnh Cần Thơ', 
                'is_correct' => 0
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?',  
                'image' => 'images/hue.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 3,
                'content' => 'Thành phố Hồ Chí Minh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 3,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 3,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 3,
                'content' => 'Tỉnh Thừa Thiên Huế', 
                'is_correct' => 1
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?',  
                'image' => 'images/binh-dinh.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 4,
                'content' => 'Thành phố Hồ Chí Minh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 4,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 4,
                'content' => 'Tỉnh Bình Định', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 4,
                'content' => 'Tỉnh Cần Thơ', 
                'is_correct' => 0
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?', 
                'image' => 'images/can-tho.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 5,
                'content' => 'Thành phố Hồ Chí Minh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 5,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 5,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 5,
                'content' => 'Tỉnh Cần Thơ', 
                'is_correct' => 1
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?', 
                'image' => 'images/phu-yen.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 6,
                'content' => 'Tỉnh Phú Yên', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 6,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 6,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 6,
                'content' => 'Tỉnh Cần Thơ', 
                'is_correct' => 0
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?', 
                'image' => 'images/da-nang.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 7,
                'content' => 'Thành phố Hồ Chí Minh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 7,
                'content' => 'Thành phố Đà Nẵng', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 7,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 7,
                'content' => 'Tỉnh Cần Thơ', 
                'is_correct' => 0
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?',  
                'image' => 'images/nghe-an.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 8,
                'content' => 'Tỉnh Nghệ An', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 8,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 8,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 8,
                'content' => 'Tỉnh Phú Yên', 
                'is_correct' => 0
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?',  
                'image' => 'images/lam-dong.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 9,
                'content' => 'Thành phố Hồ Chí Minh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 9,
                'content' => 'Tỉnh Lâm Đồng', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 9,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 9,
                'content' => 'Tỉnh Gia Lai', 
                'is_correct' => 0
            ]
        );

        DB::table('questions')->insert(
            [
                'quiz_id' => 1,
                'excerpt' => 'Đây là tỉnh/thành phố thành nào?', 
                'image' => 'images/gia-lai.png'
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 10,
                'content' => 'Tỉnh Gia Lai', 
                'is_correct' => 1
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 10,
                'content' => 'Tỉnh Tây Ninh', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 10,
                'content' => 'Thành phố Hà Nội', 
                'is_correct' => 0
            ]
        );

        DB::table('answers')->insert(
            [
                'question_id' => 10,
                'content' => 'Tỉnh Cần Thơ', 
                'is_correct' => 0
            ]
        );


        //
        // $faker = Faker::create();
        // for ($i = 0; $i < 5; $i++) {
        //     $quiz = Quiz::create([
        //         'title' => $faker->sentence,
        //         'description' => $faker->paragraph,
        //     ]);

        //     for ($j = 0; $j < 10; $j++) { // 10 câu hỏi cho mỗi quiz
        //         $question = $quiz->questions()->create([
        //             'excerpt' => $faker->sentence,
        //             'type' => $faker->randomElement(['checkbox']),
        //         ]);

        //         $numAnswers = $question->type === 'text' ? 1 : $faker->numberBetween(2, 4); 
        //         for ($k = 0; $k < $numAnswers; $k++) {
        //             $question->answers()->create([
        //                 'content' => $faker->sentence,
        //                 'is_correct' => $k === 0, // Câu trả lời đầu tiên luôn đúng
        //             ]);
        //         }
        //     }
        // }
    }
}
