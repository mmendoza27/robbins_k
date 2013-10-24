package projecttrack1

class User {
    String userName
    String password
    String fullName
    static hasMany = [projects : Project, tasks : Task]

    static constraints = {
    }
}
