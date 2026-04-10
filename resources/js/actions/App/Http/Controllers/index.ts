import Settings from './Settings'
import Auth from './Auth'
import Authorization from './Authorization'
const Controllers = {
    Settings: Object.assign(Settings, Settings),
Auth: Object.assign(Auth, Auth),
Authorization: Object.assign(Authorization, Authorization),
}

export default Controllers