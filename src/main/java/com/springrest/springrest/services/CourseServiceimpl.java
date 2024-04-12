package com.springrest.springrest.services;

import java.util.ArrayList;
import java.util.List;
import java.util.stream.Collectors;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.stereotype.Service;

import com.springrest.springrest.dao.CourseDao;
import com.springrest.springrest.entities.Course;

@Service
public class CourseServiceimpl implements CourseService {

	//List<Course> list;
	
	@Autowired
	private CourseDao courseDao;
	
	
	public CourseServiceimpl()
	{
		//list = new ArrayList<>();
		//list.add(new Course(145,"java", "basic of java"));
		//list.add(new Course(146,"SpringBoot", "creatinf restapi using SpringBoot"));
		//list.add(new Course(147,"Angular", "basic of Angular"));
	}
	
	@Override
	public List<Course> getCourses() {
		return courseDao.findAll() ;
		//return list;
	}

	@Override
	public Course getCourse(Long courseId) {
		
		
		//Course c = null;
		//for (Course course : list) {
			//if(course.getId() == courseId)
			//{
				//c = course ;
				//break;
			//}
		//}
		//return  c;
		return courseDao.getOne(courseId);
	}

	@Override
	public Course addCourse(Course course) {
	
		//list.add(course);
		//return course;
		courseDao.save(course);
		return course;
	}

	@Override
	public Course updateCourse(Course course) {
		
		//list.forEach(e -> {
			//if (e.getId() == course.getId()) {
				//e.setTitle(course.getTitle());
				//e.setDescription(course.getDescription());
			//}
		//});
		//return course;
		courseDao.save(course);
		
		return course;
	}

	@Override
	public void deleteCourse(long parseLong) {
	
		//list = this.list.stream().filter(e->e.getId()!=parseLong).collect(Collectors.toList());
		Course entity = courseDao.getOne(parseLong);
		courseDao.delete(entity);
	}

}
