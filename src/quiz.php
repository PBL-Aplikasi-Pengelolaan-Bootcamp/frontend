<?php

include 'function.php';


$data_login = get_data_user_login();
$quiz = get_quiz_byId();
$question = get_question_byQuiz();



if (isset($_POST['submit_quiz'])) {
    // Debug: Periksa apakah data yang diterima sudah benar
    echo "<pre>";
    print_r($_POST['answer']);  // Debug untuk melihat data yang diterima
    echo "</pre>";
    quiz_answer($_POST['answer']); // Kirim array answer saja
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simplify | Kursus</title>
    <link href="output.css" rel="stylesheet" />
    <link href="img/logo.png" rel="shortcut icon" />
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body>
    <div class=" m-auto">
        <div class="w-11/12 mt-12 m-auto flex flex-col gap-5 my-10">
            <h1 class="font-semibold font-poppins text-2xl"><?=$quiz['title']?></h1>

            <?php $i = 1; ?>
            <form method="post" action="" id="quizForm">
                <?php foreach ($question as $data) { 
        $option = get_option_byQuestion($data['id_question']);
    ?>
                <div class="flex flex-col gap-5">
                    <div class="p-5 md:p-8 border-2 border-gray-400 rounded-xl">
                        <h1 class="font-poppins font-semibold">
                            <?=$i++?>. <?=$data['question']?>
                        </h1>
                        <div class="ml-4">
                            <?php foreach ($option as $opt) { ?>
                            <div class="mt-3">
                                <input type="radio" id="option_<?=$data['id_question']?>_<?=$opt['id_quiz_option']?>"
                                    name="answer[<?=$data['id_question']?>][id_quiz_option]"
                                    value="<?=$opt['id_quiz_option']?>"
                                    onclick="setIsRight(<?=$data['id_question']?>, <?=$opt['is_right']?>)" required>
                                <input type="hidden" id="is_right_<?=$data['id_question']?>"
                                    name="answer[<?=$data['id_question']?>][is_right]" value="0">
                                <label
                                    for="option_<?=$data['id_question']?>_<?=$opt['id_quiz_option']?>"><?=$opt['option']?></label>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } ?>

                <div class="flex justify-end mt-4">
                    <button type="submit" name="submit_quiz"
                        class="py-2 px-3 bg-blue-700 font-poppins font-semibold text-white tracking-wide w-max rounded-md">
                        Selesai
                    </button>
                </div>
            </form>


            <script>
            function setIsRight(questionId, isRight) {
                console.log('Setting is_right for question ' + questionId + ' to ' + isRight);
                document.getElementById('is_right_' + questionId).value = isRight;
            }
            </script>






        </div>



    </div>

</body>
<script>
const dropdownButton = document.getElementById('dropdownButton');
const dropdownMenu = document.getElementById('dropdownMenu');

dropdownButton.addEventListener('click', () => {
    dropdownMenu.classList.toggle('hidden');
});

// Close dropdown when clicking outside of it
window.addEventListener('click', (event) => {
    if (!dropdownButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add('hidden');
    }
});

// Modal PopUp Edit Profile
document.getElementById("open-modal-btn").addEventListener("click", () => {
    document.getElementById("modal-wrapper").classList.remove("hidden")
})

document.getElementById("close-modal-btn").addEventListener("click", () => {
    document.getElementById("modal-wrapper").classList.add("hidden")
})
</script>

</html>