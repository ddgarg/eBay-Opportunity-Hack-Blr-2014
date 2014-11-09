package com.rangde.api.model;

import java.util.List;

import javax.xml.bind.annotation.XmlRootElement;

@XmlRootElement
public class Search {
	
	private List<String> categories;
	private String volunteer;
	private String location;
	private String language;
	private String timeLeft;
	private String percentFunded;
	private String fundingStatus;
	
	public List<String> getCategories() {
		return categories;
	}
	public void setCategories(List<String> categories) {
		this.categories = categories;
	}
	public String getVolunteer() {
		return volunteer;
	}
	public void setVolunteer(String volunteer) {
		this.volunteer = volunteer;
	}
	public String getLocation() {
		return location;
	}
	public void setLocation(String location) {
		this.location = location;
	}
	public String getLanguage() {
		return language;
	}
	public void setLanguage(String language) {
		this.language = language;
	}
	public String getTimeLeft() {
		return timeLeft;
	}
	public void setTimeLeft(String timeLeft) {
		this.timeLeft = timeLeft;
	}
	public String getPercentFunded() {
		return percentFunded;
	}
	public void setPercentFunded(String percentFunded) {
		this.percentFunded = percentFunded;
	}
	public String getFundingStatus() {
		return fundingStatus;
	}
	public void setFundingStatus(String fundingStatus) {
		this.fundingStatus = fundingStatus;
	}

}
