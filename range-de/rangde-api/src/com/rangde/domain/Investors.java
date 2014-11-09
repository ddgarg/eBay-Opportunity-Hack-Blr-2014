package com.rangde.domain;

public class Investors {

	
	private Integer id;
	private Integer imageId;
	private String organization;
	private String occupation;
	private String nick_name;
	private Integer has_invested;
	public Integer getId() {
		return id;
	}
	public void setId(Integer id) {
		this.id = id;
	}
	public Integer getImageId() {
		return imageId;
	}
	public void setImageId(Integer imageId) {
		this.imageId = imageId;
	}
	public String getOrganization() {
		return organization;
	}
	public void setOrganization(String organization) {
		this.organization = organization;
	}
	public String getOccupation() {
		return occupation;
	}
	public void setOccupation(String occupation) {
		this.occupation = occupation;
	}
	public String getNick_name() {
		return nick_name;
	}
	public void setNick_name(String nick_name) {
		this.nick_name = nick_name;
	}
	public Integer getHas_invested() {
		return has_invested;
	}
	public void setHas_invested(Integer has_invested) {
		this.has_invested = has_invested;
	}
}
