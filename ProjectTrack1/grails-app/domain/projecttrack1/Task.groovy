package projecttrack1

class Task {
    String name
    String description
    Date dueDate
    static belongsTo = [assignee : User, project : Project]
	
    static constraints = {
    }
}
