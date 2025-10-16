// Notification pour nouvelles commandes
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'mt1',
    forceTLS: true
});

if (window.adminId) {
    window.Echo.private(`App.Models.Admin.${window.adminId}`)
        .notification((notification) => {
            // Jouer un son de notification
            const audio = new Audio('/notification.mp3');
            audio.play();

            // Afficher une alerte avec le message
            alert(notification.message);
        });
}
