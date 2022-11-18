import Cookie from 'js-cookie'

export default {
    auth(to, from, next) {
        // const token = localStorage.getItem('logged_token');
        const token = Cookie.get('logged_token');

        if (!token) {
            console.log('Token não encontrado');
            next('/page_not_found');
        } else {
            console.log('acesso concedido');
            next();
        }
    }
}