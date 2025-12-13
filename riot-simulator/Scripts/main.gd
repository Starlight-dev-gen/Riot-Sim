extends Node
@export var enemy_scene : PackedScene
var score
var hp = 3
var Timer_label = null
var Health_label = null

# Called when the node enters the scene tree for the first time.
func _ready() -> void:
	_new_game()
	Globals.time = 0
	Timer_label = get_node("HBoxContainer").find_child("Timer")
	Health_label = get_node("HBoxContainer2").find_child("health")


# Called every frame. 'delta' is the elapsed time since the previous frame.
func _process(delta: float) -> void:
	Globals.time += delta
	Timer_label.text = str(round(Globals.time)).trim_suffix(".0")
	Health_label.text = str(hp)

	# if(Input.is_action_pressed("Instant_death")) :
	# 	get_tree().change_scene_to_file("res://Scenes/death.tscn")


func _on_player_hit() -> void:
	if hp == 1:
		_game_over()
	else:
		hp -=1


func _game_over():
	get_node("ScoreTimer").stop()
	JavaScriptBridge.eval(str("saveScoreToServer(", score, ");"))
	get_node("EnemyTimer").stop()
	if get_tree() != null:
		await get_tree().create_timer(0.25).timeout
	get_tree().change_scene_to_file("res://Scenes/death.tscn")


func _new_game():
	score = 0
	get_node("Player").position = (get_node("StartPosition").position)
	get_node("StartTimer").start()


func _on_enemy_timer_timeout() -> void:
	var enemy = enemy_scene.instantiate() # Create a new instance of the enemy.
	var ranny = randi_range(0,3)
	if ranny == 0:
		enemy.position = Vector2(randf_range(0, DisplayServer.screen_get_size().x), 0)
	elif ranny == 2:
		enemy.position = Vector2(randf_range(0, DisplayServer.screen_get_size().x),
			DisplayServer.screen_get_size().y)
	elif ranny == 1:
		enemy.position = Vector2(0, randf_range(0, DisplayServer.screen_get_size().y))
	else:
		enemy.position = Vector2(DisplayServer.screen_get_size().x,
			randf_range(0, DisplayServer.screen_get_size().y))
	var direction = get_node("Player").position - enemy.position 
	enemy.linear_velocity = Vector2(direction.x, direction.y)
	# enemy.linear_velocity = enemy.linear_velocity.normalized() * enemy.linear_velocity.length()
	if (sqrt(enemy.linear_velocity.x ** 2 + enemy.linear_velocity.y **2) > 600):
		var lambda = 600 ** 2 / (enemy.linear_velocity.x ** 2 + enemy.linear_velocity.y ** 2)
		enemy.linear_velocity.x *= lambda
		enemy.linear_velocity.y *= lambda
	add_child(enemy) # Spawn the poor sod.


func _on_score_timer_timeout() -> void:
	score += 1


func _on_start_timer_timeout() -> void:
	get_node("ScoreTimer").start()
	get_node("EnemyTimer").start()
