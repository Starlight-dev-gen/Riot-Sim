extends Control


func _ready() -> void:
	var death_time_label = $HBoxContainer.find_child("death time")
	if(Globals.time == 1) :
		death_time_label.text = "you survived " + str(round(Globals.time)).trim_suffix(".0") + " second!"
	else :
		death_time_label.text = "you survived " + str(round(Globals.time)).trim_suffix(".0") + " seconds!"


func _on_retry_pressed() -> void:
	get_tree().change_scene_to_file("res://Scenes/main.tscn")


func _on_main_menu_pressed() -> void:
	get_tree().change_scene_to_file("res://Scenes/Main_Menu.tscn")
