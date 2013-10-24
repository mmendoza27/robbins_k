package projecttrack1

class Project {
		String name
		String description
		Date dueDate
		static belongsTo = [owner : User]
		static hasMany = [tasks : Task]

    static constraints = {
    }
}
