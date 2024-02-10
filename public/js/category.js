document.addEventListener('DOMContentLoaded', function () {
    const selectGroup = document.getElementById('select-group');
    const groupName = document.getElementById('group-name');
    const groupInput = document.getElementById('group');

    selectGroup.addEventListener('change', function () {
        if (selectGroup.value !== '0') {
            groupInput.value = selectGroup.value;
            groupName.classList.add('hidden');
        } else {
            groupInput.value = '';
            groupName.classList.remove('hidden');
        }
    });
});