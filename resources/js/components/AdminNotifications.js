// resources/js/components/AdminNotifications.js
import { ref, onMounted } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const notifications = ref([]);
        const unreadCount = ref(0);

        const fetchNotifications = async () => {
            try {
                const response = await axios.get('/api/admin/notifications');
                notifications.value = response.data;
                unreadCount.value = notifications.value.length;
            } catch (error) {
                console.error('Erreur lors de la récupération des notifications:', error);
            }
        };

        const markAsRead = async (id) => {
            try {
                await axios.post(`/api/admin/notifications/${id}/mark-as-read`);
                await fetchNotifications();
            } catch (error) {
                console.error('Erreur lors du marquage de la notification:', error);
            }
        };

        const markAllAsRead = async () => {
            try {
                await axios.post('/api/admin/notifications/mark-all-as-read');
                await fetchNotifications();
            } catch (error) {
                console.error('Erreur lors du marquage des notifications:', error);
            }
        };

        onMounted(() => {
            fetchNotifications();

            // Configuration de Laravel Echo pour les notifications en temps réel
            window.Echo.private(`App.Models.Admin.${window.adminId}`)
                .notification((notification) => {
                    notifications.value.unshift(notification);
                    unreadCount.value++;
                    // Afficher une notification toast
                    showToast(notification.message);
                });
        });

        const showToast = (message) => {
            // Vous pouvez utiliser une bibliothèque de toast comme toastr ou sweetalert2
            // ou créer votre propre fonction d'affichage de notification
            alert(message); // À remplacer par votre système de toast préféré
        };

        return {
            notifications,
            unreadCount,
            markAsRead,
            markAllAsRead
        };
    },
    template: `
        <div class="notifications-dropdown">
            <button class="notifications-trigger">
                Notifications
                <span v-if="unreadCount > 0" class="notification-badge">{{ unreadCount }}</span>
            </button>
            <div class="notifications-content" v-if="notifications.length > 0">
                <div class="notification-header">
                    <h3>Notifications</h3>
                    <button @click="markAllAsRead" v-if="unreadCount > 0">
                        Tout marquer comme lu
                    </button>
                </div>
                <div class="notifications-list">
                    <div v-for="notification in notifications"
                         :key="notification.id"
                         class="notification-item"
                         :class="{ 'unread': !notification.read_at }">
                        <a :href="notification.data.url" @click="markAsRead(notification.id)">
                            {{ notification.data.message }}
                        </a>
                    </div>
                </div>
            </div>
            <div v-else class="notifications-empty">
                Aucune notification
            </div>
        </div>
    `
};
