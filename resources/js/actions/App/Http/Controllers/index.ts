import DashboardController from './DashboardController'
import Settings from './Settings'
import Auth from './Auth'
import Authorization from './Authorization'
import Resources from './Resources'
import QueueController from './QueueController'
import ReportController from './ReportController'
const Controllers = {
    DashboardController: Object.assign(DashboardController, DashboardController),
Settings: Object.assign(Settings, Settings),
Auth: Object.assign(Auth, Auth),
Authorization: Object.assign(Authorization, Authorization),
Resources: Object.assign(Resources, Resources),
QueueController: Object.assign(QueueController, QueueController),
ReportController: Object.assign(ReportController, ReportController),
}

export default Controllers