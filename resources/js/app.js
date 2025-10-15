document.addEventListener('admin:confirm-delete', () => {
    console.log('event registered.');
    const modal = document.getElementById('my_modal_1');
    if (modal) modal.showModal();
});
