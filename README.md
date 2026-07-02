# 📘 Question Management (Vue + Laravel)

## 🚀 Giới thiệu

Module quản lý câu hỏi gồm:

* Danh sách câu hỏi
* Tạo mới câu hỏi
* Chỉnh sửa câu hỏi
* Xoá câu hỏi

Frontend: Vue 3 + Ant Design Vue
Backend: Laravel API

---

## 🧠 Luồng hoạt động tổng thể

```
User
  ↓
Vue Page (List / Create / Edit)
  ↓
Component (QuestionForm)
  ↓
Service (questionService)
  ↓
API (Laravel)
  ↓
Response
  ↓
Render UI / Redirect
```

---

## 📂 Cấu trúc thư mục

```
src/
├── views/
│   └── question/
│       ├── QuestionList.vue
│       ├── QuestionCreate.vue
│       └── QuestionEdit.vue
│
├── components/
│   └── forms/
│       └── QuestionForm.vue
│
├── services/
│   └── question_service.ts
```

---

## 🌐 API Endpoints

```
GET    /api/question?page=1        → Lấy danh sách
GET    /api/question/{id}          → Lấy chi tiết
POST   /api/question               → Tạo mới
PUT    /api/question/{id}          → Cập nhật
DELETE /api/question/{id}          → Xoá
```

---

## 🔄 Flow chi tiết

### 🟢 Create

```
Mở trang create
   ↓
Form rỗng
   ↓
User nhập dữ liệu
   ↓
Submit
   ↓
POST /api/question
   ↓
Success → redirect list
```

---

### 🟣 Edit

```
Mở trang edit
   ↓
GET /api/question/{id}
   ↓
Nhận data
   ↓
Truyền xuống QuestionForm
   ↓
watch(props.data)
   ↓
Fill form
   ↓
User chỉnh sửa
   ↓
Submit
   ↓
PUT /api/question/{id}
   ↓
Success → redirect list
```

---

## 🧩 Cấu trúc dữ liệu

```
Question
├── title
├── question_type_code
├── answer_type_code
├── subject_id
├── difficulty
├── score
├── status
├── version
├── question_data
│   └── question_content
└── answer_data
    ├── answer_contents[]
    │   ├── answer_id (A, B, C, D)
    │   └── answer_content
    └── correct_answer[]
        ├── answer_id
        └── answer_content
```

---

## 🔁 Mapping Form → Payload

### 📥 Form (UI)

```
form.answers = {
  A: '3',
  B: '4',
  C: '5',
  D: '6'
}

form.correct = 'B'
```

---

### 📤 Payload (API)

```
answer_contents = [
  { answer_id: 'A', answer_content: '3' },
  { answer_id: 'B', answer_content: '4' },
  { answer_id: 'C', answer_content: '5' },
  { answer_id: 'D', answer_content: '6' }
]

correct_answer = [
  {
    answer_id: 'B',
    answer_content: '4'
  }
]
```

---

## 📦 Ví dụ payload hoàn chỉnh

```
{
  "title": "Câu hỏi 1",
  "question_type_code": "SINGLE",
  "answer_type_code": "TEXT",
  "subject_id": "1",
  "difficulty": "easy",
  "score": 1,
  "status": 1,
  "version": 1,

  "question_data": {
    "question_content": "2 + 2 = ?"
  },

  "answer_data": {
    "answer_contents": [
      { "answer_id": "A", "answer_content": "3" },
      { "answer_id": "B", "answer_content": "4" },
      { "answer_id": "C", "answer_content": "5" },
      { "answer_id": "D", "answer_content": "6" }
    ],
    "correct_answer": [
      { "answer_id": "B", "answer_content": "4" }
    ],
    "shuffle": true
  }
}
```

---

## ⚙️ Submit Flow

```
submitForm()
   ↓
Lấy dữ liệu từ form
   ↓
Build payload
   ↓
if edit → PUT
else → POST
   ↓
API trả kết quả
   ↓
Hiển thị message
   ↓
Redirect về list
```

---

## 🔌 Service Flow

```
Component
   ↓
questionService
   ↓
fetch / axios
   ↓
API
   ↓
Response JSON
   ↓
Component xử lý
```

---

## ⚠️ Notes quan trọng

* Form dùng chung cho create + edit
* Edit phải dùng `watch(props.data)` để fill dữ liệu
* Payload phải đúng format backend
* answer_id luôn là A, B, C, D
* correct_answer phải khớp với answer_contents
* Không map đúng → backend sẽ lỗi

---

## 🐛 Debug Tips

```
console.log(props.data)   → check data API
console.log(form.value)   → check form
console.log(payload)      → check trước khi submit
```

👉 Mở tab Network:

* Check request gửi đi
* Check response trả về

---

## 🎯 Tóm tắt 1 dòng

```
Form (UI) → Map data → Payload → API → Success → Redirect
```

---

## 🚀 Kết luận

* questionService giúp tái sử dụng API
* QuestionForm dùng chung create + edit
* watch giúp sync dữ liệu từ API → form
* Payload là phần quan trọng nhất cần đúng format

---
