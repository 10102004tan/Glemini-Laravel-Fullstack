

// click edit btn question
const btnSettings = document.getElementById('btn-settings');
const btnCloseSettings = document.querySelector('.btn-close-settings');
const settings = document.querySelector('.settings');
const btnEditQuestions = document.querySelectorAll('.btn-edit-question');
const modalEditQuestion = document.querySelectorAll('.modal-edit-question');
const modalDestroyQuestion = document.querySelectorAll('.modal-destroy-question');
const modalQuestion = document.querySelectorAll('.modal-question');
const btnCancels = document.querySelectorAll('.btn-cancel');
const btnEditQuiz = document.querySelector('.btn-edit-quiz');
const modelEditQuiz = document.querySelector('.modal-edit-quiz');
const btnCloseEditQuiz = document.querySelector('.btn-close-modal-edit-quiz');
const showOptions = document.querySelectorAll('.show-option');
const overlayLoading = document.querySelector('.overlay-loading');
const btnGenerateAI = document.querySelector('.btn-generate-ai');
const resultIntro = document.querySelector('.result-intro');
const resultQuestions = document.querySelector('.result-questions');
const selectOptionQuestion = document.querySelector('.select-option-manual-question');
const selectOptionManualCorrect = document.querySelector('.select-option-manual-correct');
const modalUpdateQuiz = document.querySelector('.modal-update-quiz');
const btnPublished = document.querySelector('.btn-published');
const formSetting = document.getElementById('form-setting');

// click published btn
if (btnPublished != null) {
    btnPublished.addEventListener('click',function (e) {
        e.preventDefault();
        Swal.fire({
            title: 'Xác nhận publish quiz',
            text: 'Bạn có muốn publish quiz này không?',
            icon: 'info',
            customClass: {
                popup: 'z-[9999]'
            },
            confirmButtonText: 'Yes',
        }).then(async (result) => {
            if (result.isConfirmed) {
                const formData = new FormData();
                formData.append('quizId', btnPublished.getAttribute('quizId'));
                try {
                    const url = window.routes.quizzesPublished;
                    const response = await axios.post(url, formData);
                    const data = response.data;
                    checkStatus(data, function () {
                        btnPublished.textContent = 'Pending';
                        btnPublished.classList.add('bg-yellow-200');

                    },
                        function () {
                            //error
                        });

                } catch (error) {
                    console.error('Error:', error);
                }
            }
        });

    });
}

//reset form




if (btnEditQuiz != null) {
    btnEditQuiz.addEventListener('click', function () {
        modelEditQuiz.classList.toggle('invisible');
        modelEditQuiz.classList.toggle('opacity-0');
    });
}

if (btnCloseEditQuiz != null) {
    btnCloseEditQuiz.addEventListener('click', function () {
        modelEditQuiz.classList.toggle('invisible');
        modelEditQuiz.classList.toggle('opacity-0');
    });
};

if (btnSettings != null) {
    
    btnSettings.addEventListener('click', function () {
        settings.classList.toggle('right-[-100%]');
        settings.classList.toggle('right-0');
    });
    btnCloseSettings.addEventListener('click', function () {
        settings.classList.toggle('right-[-100%]');
        settings.classList.toggle('right-0');
    });
}

if (formSetting != null) {
    console.log(formSetting);
    formSetting.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(formSetting);
        const point = formData.get('point');
        const time = formData.get('time');
        formData.append('point', point);
        formData.append('time', time);
        formData.append('quizId', formSetting.getAttribute('quizId'));
        try {
            const url = window.routes.quizzesSetting;
            const response = await axios.post(url, formData);
            const data = response.data;
            checkStatus(data, function () {
                settings.classList.toggle('right-[-100%]');
            },
                function () {
                    //error
                });
        } catch (error) {
            console.error('Error:', error);
        }
    });
}


if (modalUpdateQuiz != null) {
    // update quiz
    modalUpdateQuiz.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btnSubmit = modalUpdateQuiz.querySelector('.btn-update-quiz');
        btnSubmit.textContent = 'Updating...';
        const formData = new FormData(modalUpdateQuiz);
        try {
            // // Send AJAX POST request using Axios
            const url = window.routes.quizzesUpdate;
            const response = await axios.post(url, formData);
            const result = response.data;
            checkStatus(result, function () {
                btnSubmit.textContent = 'Update';
                modalUpdateQuiz.parentElement.previousElementSibling.firstElementChild.firstElementChild.textContent = result.quiz.title;
            },
                function () {
                    //show error
                });
        } catch (error) {
            console.error('Error:', error);
        }
    });
}


function checkStatus(result, callbackSuccess, callbackOrder) {
    if (result.status == 200) {
        Toastify({
            text: `${result.message}`,
            duration: 1000,
            destination: `${result.message}`,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: "#26d63a",
            },
        }).showToast();
        callbackSuccess();
    }
    else {

        Toastify({
            text: `${result.message}`,
            duration: 2000,
            destination: `${result.message}`,
            newWindow: true,
            close: true,
            gravity: "top", // `top` or `bottom`
            position: "right", // `left`, `center` or `right`
            stopOnFocus: true, // Prevents dismissing of toast on hover
            style: {
                background: `${(result.status == 999) ? "#26d63a" : "#cd4316"}`,
            },
            callback: function (instance, toast) {
                callbackOrder();
            }
        }).showToast();
    }
}