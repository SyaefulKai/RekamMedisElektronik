import Settings from './Settings'
import Auth from './Auth'
import Authorization from './Authorization'
import Resources from './Resources'
const Controllers = {
    Settings: Object.assign(Settings, Settings),
Auth: Object.assign(Auth, Auth),
Authorization: Object.assign(Authorization, Authorization),
Resources: Object.assign(Resources, Resources),
}

export default Controllers