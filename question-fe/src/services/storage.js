// lưu token
export function setToken(token) {
  localStorage.setItem('token', token)
}

// lấy token
export function getToken() {
  return localStorage.getItem('token')
}

// xoá token
export function removeToken() {
  localStorage.removeItem('token')
}
