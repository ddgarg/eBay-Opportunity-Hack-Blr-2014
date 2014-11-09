package com.rangde.api;

import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.util.HashMap;
import java.util.Map;

import javax.ws.rs.Consumes;
import javax.ws.rs.FormParam;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.Produces;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.MediaType;
import javax.ws.rs.core.Request;
import javax.ws.rs.core.Response;
import javax.ws.rs.core.UriInfo;
import javax.ws.rs.core.Response.ResponseBuilder;
import javax.ws.rs.PathParam;

import org.glassfish.jersey.media.multipart.FormDataContentDisposition;

import com.rangde.api.model.Message;

@Path("/file")
public class FileResource {
	
	@Context
	UriInfo uriInfo;
	@Context
	Request request;
	
	//Hack, lets keep file in memory
	private static Integer fileCounter = 0;
	private Map<Integer, String> fileMap = new HashMap<Integer, String>();
	
	/*
	
	@POST
	@Path("upload")
	@Consumes(MediaType.MULTIPART_FORM_DATA)
	@Produces(MediaType.APPLICATION_JSON)
	public Message uploadFile(
			@FormParam("file") InputStream fileInputStream,
			@FormParam("file") FormDataContentDisposition fileDisposition)
			throws FileNotFoundException, IOException {
 
		String fileName = fileDisposition.getFileName();
		System.out.println("FileName " + fileDisposition.getFileName());
		String filePath = fileName;
		try {
			OutputStream fileOutputStream = new FileOutputStream(filePath);
				int read = 0;
				final byte[] bytes = new byte[1024];
				while ((read = fileInputStream.read(bytes)) != -1) {
					fileOutputStream.write(bytes, 0, read);
				}
			fileMap.put(fileCounter, fileName);
			fileOutputStream.close();
		} catch (Exception e) {e.printStackTrace();}

		return new Message(fileCounter.toString());
	}
	
	*/
	
	/*
	
	@GET
	@Path("{id}")
	@Produces("text/plain")
	public Response getTextFile(@PathParam("todo") Integer id) {
		File file = new File(fileMap.get(id));
		ResponseBuilder response = Response.ok((Object) file);
		response.header("Content-Disposition", "attachment; filename=\""+fileMap.get(id)+"\"");
		return response.build();
	}
	
	*/

}
