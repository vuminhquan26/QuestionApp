import { http } from '../api/http'

export async function getTeacherDashboard() {
  return await http('/teacher/dashboard')
}
