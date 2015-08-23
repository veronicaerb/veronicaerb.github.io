require "erb"

class Draft < Thor
  include Thor::Actions

  desc "create [TITLE]", "Create a new draft blog post"
  def create(title)
    puts "Generating draft blog post: #{title}"

    md = ERB.new(File.read('./tasks/templates/draft.erb')).result(binding)

    file = "_drafts/" + [title.downcase.gsub(/\W+/, '-')].join('-') + '.md'

    exists = File.exists?(file)
    overwrite = yes? "Do you want to overwrite #{file}?" if exists

    if !exists || overwrite
      File.open(file, 'w') {|f| f.write(md)}
      `$EDITOR #{file}`
    else
      puts "Not going to overwrite #{file}. Move it, or try a different title."
    end
  end

  no_tasks {
    def full_date
      DateTime.now.strftime('%F %T.%6N %:z')
    end

    def short_date
      DateTime.now.strftime('%F')
    end
  }
end
