<%@ page import="projecttrack1.User" %>



<div class="fieldcontain ${hasErrors(bean: userInstance, field: 'fullName', 'error')} ">
	<label for="fullName">
		<g:message code="user.fullName.label" default="Full Name" />
		
	</label>
	<g:textField name="fullName" value="${userInstance?.fullName}"/>
</div>

<div class="fieldcontain ${hasErrors(bean: userInstance, field: 'password', 'error')} ">
	<label for="password">
		<g:message code="user.password.label" default="Password" />
		
	</label>
	<g:textField name="password" value="${userInstance?.password}"/>
</div>

<div class="fieldcontain ${hasErrors(bean: userInstance, field: 'projects', 'error')} ">
	<label for="projects">
		<g:message code="user.projects.label" default="Projects" />
		
	</label>
	
<ul class="one-to-many">
<g:each in="${userInstance?.projects?}" var="p">
    <li><g:link controller="project" action="show" id="${p.id}">${p?.encodeAsHTML()}</g:link></li>
</g:each>
<li class="add">
<g:link controller="project" action="create" params="['user.id': userInstance?.id]">${message(code: 'default.add.label', args: [message(code: 'project.label', default: 'Project')])}</g:link>
</li>
</ul>

</div>

<div class="fieldcontain ${hasErrors(bean: userInstance, field: 'tasks', 'error')} ">
	<label for="tasks">
		<g:message code="user.tasks.label" default="Tasks" />
		
	</label>
	
<ul class="one-to-many">
<g:each in="${userInstance?.tasks?}" var="t">
    <li><g:link controller="task" action="show" id="${t.id}">${t?.encodeAsHTML()}</g:link></li>
</g:each>
<li class="add">
<g:link controller="task" action="create" params="['user.id': userInstance?.id]">${message(code: 'default.add.label', args: [message(code: 'task.label', default: 'Task')])}</g:link>
</li>
</ul>

</div>

<div class="fieldcontain ${hasErrors(bean: userInstance, field: 'userName', 'error')} ">
	<label for="userName">
		<g:message code="user.userName.label" default="User Name" />
		
	</label>
	<g:textField name="userName" value="${userInstance?.userName}"/>
</div>

